@extends('frontend.layouts.master')

@section('title','Returns & Exchanges')

@section('main-content')

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow mb-4 border-0">
                <div class="card-body p-4">
                    <h2 class="mb-4 text-center text-primary"><i class="fa fa-undo mr-2"></i>Returns & Exchanges Policy</h2>
                    <div class="mb-4">
                        <div class="alert alert-info d-flex align-items-center" role="alert">
                            <i class="fa fa-info-circle fa-2x mr-3"></i>
                            <div>
                                <b>Aside from valid <span class="text-success">Warranty Claims</span>, we reserve the right to accept or reject all return or exchange requests.</b> To ensure our engineering team remains focused on technical support and quality control, we have implemented the following guidelines:
                            </div>
                        </div>
                        <div class="stepper mb-4">
                            <div class="step mb-3">
                                <span class="badge badge-primary mr-2"><i class="fa fa-check-circle"></i> Eligibility</span>
                                Requests may be considered within <b>7 days of purchase</b>, provided the item is in its original, unopened, and sealed condition.
                            </div>
                            <div class="step mb-3">
                                <span class="badge badge-warning mr-2"><i class="fa fa-search"></i> Inspection Process</span>
                                All returned items undergo a technical inspection by our sales and engineering team. This process may take up to <b>7 business days</b>.
                            </div>
                            <div class="step mb-3">
                                <span class="badge badge-info mr-2"><i class="fa fa-money"></i> Service Fees</span>
                                Depending on the complexity of the testing required, a diagnostic fee may be charged to the customer.
                            </div>
                            <div class="step mb-3">
                                <span class="badge badge-success mr-2"><i class="fa fa-check"></i> Finalization</span>
                                Once the item is verified to be in its original condition, we will proceed with the refund or exchange.
                            </div>
                        </div>
                        <div class="alert alert-light border-left border-primary" role="alert">
                            <i class="fa fa-comments mr-2"></i>We will check and let you know the status of the items. You can discuss with us whether to receive a refund or buy different items.
                        </div>
                    </div>
                    <hr>
                    <div class="mb-4">
                        <h4 class="text-success mb-3"><i class="fa fa-language mr-2"></i>භාණ්ඩ ආපසු භාරගැනීමේ සහ හුවමාරු කිරීමේ ප්‍රතිපත්තිය</h4>
                        <div class="card bg-light border-0 mb-3">
                            <div class="card-body">
                                <div class="alert alert-success d-flex align-items-center" role="alert">
                                    <i class="fa fa-info-circle fa-lg mr-2"></i>
                                    <div>
                                        වගකීම් සහතිකයට (Warranty Claims) අදාළ ඉල්ලීම් හැර, අනෙකුත් ඕනෑම භාණ්ඩ ආපසු භාරගැනීමේ හෝ හුවමාරු කිරීමේ ඉල්ලීමක් පිළිගැනීමට හෝ ප්‍රතික්ෂේප කිරීමට අප ආයතනය සතු අයිතිය අප රඳවා තබා ගනිමු. අපගේ ඉංජිනේරු කණ්ඩායමේ කාර්යක්ෂමතාව සහ තාක්ෂණික සහාය ලබාදීමේ හැකියාව උපරිම මට්ටමක පවත්වා ගැනීම සඳහා පහත සඳහන් මාර්ගෝපදේශ ක්‍රියාත්මක වේ:
                                    </div>
                                </div>
                                <div class="stepper mb-3">
                                    <div class="step mb-2">
                                        <span class="badge badge-primary mr-2">සුදුසුකම</span>
                                        භාණ්ඩය මිලදී ගෙන දින 7ක් ඇතුළත, එය විවෘත නොකළ (Unopened), මුද්‍රා තැබූ (Sealed) සහ භාවිතයට නොගත් තත්වයේ පවතී නම් පමණක් එම ඉල්ලීම් සලකා බලනු ලැබේ.
                                    </div>
                                    <div class="step mb-2">
                                        <span class="badge badge-warning mr-2">පරීක්ෂා කිරීමේ ක්‍රියාවලිය</span>
                                        ආපසු ලබාදෙන සියලුම භාණ්ඩ අපගේ විකුණුම් සහ ඉංජිනේරු කණ්ඩායම විසින් තාක්ෂණික පරීක්ෂාවකට ලක් කරනු ලැබේ. මේ සඳහා වැඩ කරන දින 7ක් දක්වා කාලයක් ගත විය හැක.
                                    </div>
                                    <div class="step mb-2">
                                        <span class="badge badge-info mr-2">සේවා ගාස්තු</span>
                                        පරීක්ෂණ ක්‍රියාවලියේ සංකීර්ණත්වය අනුව, ඒ සඳහා වන පරීක්ෂණ ගාස්තුවක් පාරිභෝගිකයාගෙන් අය කිරීමට අපට සිදු විය හැක.
                                    </div>
                                    <div class="step mb-2">
                                        <span class="badge badge-success mr-2">අවසන් තීරණය</span>
                                        භාණ්ඩය එහි මුල් තත්වයෙන්ම පවතින බව තහවුරු වූ පසු, මුදල් ආපසු ගෙවීමේ හෝ හුවමාරු කිරීමේ ක්‍රියාවලිය අප සිදු කරනු ඇත.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
