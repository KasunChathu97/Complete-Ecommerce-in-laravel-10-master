<?php

namespace App\Exports;

use App\Models\Cart;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithEvents;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Events\AfterSheet;

class OrderItemsExport implements FromCollection, WithHeadings, WithMapping, WithDrawings, WithEvents
{
    /** @var \Illuminate\Support\Collection<int, \App\Models\Cart> */
    private Collection $items;

    /** @var array<int, string> */
    private array $imagePathByRow = [];

    private int $rowCounter = 0;

    /**
     * @param \Illuminate\Support\Collection<int, \App\Models\Cart> $items
     */
    public function __construct(Collection $items)
    {
        $this->items = $items->values();
    }

    public function collection()
    {
        return $this->items;
    }

    public function headings(): array
    {
        return [
            'Image',
            'Order No',
            'Customer',
            'Email',
            'Phone',
            'Emergency Phone',
            'Address (District)',
            'Product',
            'Qty',
            'Unit Price',
            'Courier Price',
            'Total Price',
            'Status',
            'Order Date',
        ];
    }

    /**
     * @param \App\Models\Cart $cart
     */
    public function map($cart): array
    {
        $this->rowCounter++;
        $row = 1 + $this->rowCounter; // headings are on row 1

        $order = $cart->order;
        $product = $cart->product;

        $qty = (int) ($cart->quantity ?? 0);
        $unitPrice = (float) ($cart->price ?? 0);

        $shippingPrice = (float) (optional($order?->shipping)->price ?? 0);
        $deliveryCharge = (float) ($order?->delivery_charge ?? 0);
        $courierPrice = $shippingPrice + $deliveryCharge;
        $totalPrice = ($unitPrice * $qty) + $courierPrice;

        $district = trim((string) ($order?->district ?? ''));
        if ($district === '') {
            // Backward compatible fallback (older orders may not have a district stored)
            $district = (string) (optional($order?->shipping)->type ?? '');
        }
        $address = $this->formatAddressWithDistrict(
            (string) ($order?->address1 ?? ''),
            (string) ($order?->address2 ?? ''),
            $district
        );

        $this->imagePathByRow[$row] = $this->resolveLocalImagePath($product?->photo);

        return [
            '',
            $order?->order_number,
            trim(($order?->first_name ?? '') . ' ' . ($order?->last_name ?? '')),
            $order?->email,
            $order?->phone,
            $order?->emergency_contact,
            $address,
            $product?->title,
            $qty,
            $unitPrice,
            $courierPrice,
            $totalPrice,
            $order?->status,
            optional($order?->created_at)->format('Y-m-d'),
        ];
    }

    public function drawings(): array
    {
        $drawings = [];

        foreach ($this->imagePathByRow as $row => $path) {
            if (empty($path) || !is_file($path)) {
                continue;
            }

            $drawing = new Drawing();
            $drawing->setName('Product Image');
            $drawing->setDescription('Product Image');
            $drawing->setPath($path);
            $drawing->setHeight(42);
            $drawing->setCoordinates('A' . $row);
            $drawing->setOffsetX(6);
            $drawing->setOffsetY(4);

            $drawings[] = $drawing;
        }

        return $drawings;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                // Header styling
                $event->sheet->getDelegate()->getStyle('A1:N1')->getFont()->setBold(true);

                // Make image column a bit wider
                $event->sheet->getDelegate()->getColumnDimension('A')->setWidth(14);

                // Set row height so images fit nicely
                foreach (array_keys($this->imagePathByRow) as $row) {
                    $event->sheet->getDelegate()->getRowDimension((int) $row)->setRowHeight(46);
                }

                // Align cells vertically
                $event->sheet->getDelegate()->getStyle('A:N')->getAlignment()->setVertical('center');
            },
        ];
    }

    private function formatAddressWithDistrict(string $address1, string $address2, string $district): string
    {
        $parts = [];
        foreach ([$address1, $address2] as $part) {
            $value = trim($part);
            if ($value !== '') {
                $parts[] = $value;
            }
        }

        $base = implode(', ', $parts);
        $district = trim($district);

        if ($district === '') {
            return $base;
        }

        if ($base === '') {
            return $district;
        }

        return $base . ' (' . $district . ')';
    }

    private function resolveLocalImagePath(?string $photo): string
    {
        if (empty($photo)) {
            return '';
        }

        $first = trim(explode(',', (string) $photo)[0] ?? '');
        if ($first === '') {
            return '';
        }

        // Skip remote images
        if (preg_match('~^https?://~i', $first)) {
            return '';
        }

        $relative = ltrim($first, '/\\');
        $path = public_path($relative);

        return is_file($path) ? $path : '';
    }
}
