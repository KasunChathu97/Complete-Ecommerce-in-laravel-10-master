
@extends('frontend.layouts.master')

@section('title','Terms & Conditions')

@section('main-content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow mb-4 border-0">
                <div class="card-body p-4">
                    <h2 class="mb-4 text-center"><i class="fa fa-file-text-o mr-2"></i>Terms & Conditions / Warranty</h2>
                    <hr>
                    <div class="mb-4">
                        <h4 class="text-primary"><i class="fa fa-shield mr-2"></i>Warranty</h4>
                        <p>We provide warranty for some of the products we only against manufacturing defects. Warranty details are mentioned in the product details.</p>
                        <ul class="list-unstyled ml-3">
                            <li><i class="fa fa-times-circle text-danger mr-1"></i> Do It yourself (DIY) are not covered under warranty. However, we provide checking warranty for the items you received against manufacturing defects which is not identified in inspection and damages during the delivery. Warranty will be void under certain circumstances mentioned below in this document under Warranty Terms & Conditions.</li>
                        </ul>
                    </div>
                    <div class="mb-4">
                        <h4 class="text-primary"><i class="fa fa-question-circle mr-2"></i>How to claim warranty?</h4>
                        <p>First you need to send an email mentioning/attaching <b>ALL</b> of the following details to <b>0777820662</b> via <span class="text-success">WhatsApp</span> message:</p>
                        <ol class="ml-3">
                            <li>Receipt number OR Online Order Reference of the Delimach Lanka Purchase</li>
                            <li>The wiring diagram (only if applicable)</li>
                            <li>A photo taken from top showing the way you have connected wires (only if applicable)</li>
                            <li>Two clear photos of the item (both sides) showing the physical appearance of it (It must be in the same condition at the time you bought it from us)</li>
                            <li>A photo of the power supply used showing the ratings (Including input/output voltages and current) (only if applicable)</li>
                            <li>Brief explanation of the issue you are seeing</li>
                            <li>Your personal details:
                                <ul>
                                    <li>Electronics knowledge: Sound / Average / Low (only if applicable)</li>
                                    <li>Embedded systems knowledge: Sound / Average / Low (only if applicable)</li>
                                    <li>Your contact phone number</li>
                                </ul>
                            </li>
                        </ol>
                        <p class="text-muted small"><i class="fa fa-info-circle mr-1"></i> We collect this information to tailor our technical support to your background—so we can explain issues clearly and provide assistance that matches your level of expertise.</p>
                        <p>Once all the above information is supplied and we can't see any issue to help you with, we will ask you to return the item via courier with your name, phone number, email address and bill number, pay all the relevant handling charges. <span class="text-danger">We do not pay for parcels coming to our office for warranty claims.</span> Our qualified engineering team will schedule a time, perform an investigation and contact you with their findings. This process will take up to <b>10 working days</b> excluding weekends, mercantile holidays and travel restriction times. Some of the frequently asked questions are answered below.</p>
                        <ol class="ml-3">
                            <li>Where should I hand over the defective item(s) for inspection? You need to send it via Courier or Post with reference no or purchase details</li>
                            <li>Should I pay the delivery fee? Yes, you can safely pack the items and send to us by paying all the fees involved. We will not be paying to any courier service to collect parcels.</li>
                        </ol>
                        <div class="alert alert-light border mt-3">
                            <b>Our office address is given below:</b><br>
                            Delimach Lanka (pvt) Ltd<br>
                            555/22, Ranmuthugala<br>
                            Kadawatha
                        </div>
                        <ol class="ml-3" start="6">
                            <li>What happens if we find a manufacturing defect? There are two options for you. One is to request a refund, and the other is to request a replacement. If requested a replacement, we will deliver the replacement on our delivery cost.</li>
                        </ol>
                    </div>
                    <div class="mb-4">
                        <h4 class="text-primary"><i class="fa fa-gavel mr-2"></i>WARRANTY TERMS & CONDITIONS</h4>
                        <p>Warranty will be void if one or many of the following conditions have met:</p>
                        <ol class="ml-3">
                            <li>Burn marks caused by short circuitry</li>
                            <li>Mechanical damage of defective unit</li>
                            <li>Any modification applied to the unit which was not performed by authorized personnel</li>
                            <li>Inappropriate installation or commissioning</li>
                            <li>Negligence or inappropriate use of the product</li>
                            <li>External event (overvoltage, failure of other components in the installation causing our unit to fail, etc.)</li>
                            <li>Non observance of documentation, including preventative maintenance</li>
                            <li>Force majeure, including but not restricted to lightning, power surges, natural disasters, and fires</li>
                            <li>Returned unit shows no fault after analysis</li>
                            <li>Improper or no application of safety regulations</li>
                            <li>Utilization in combination with equipment, items or materials not permitted by documentation</li>
                        </ol>
                    </div>
                    <div class="mb-4">
                        <h4 class="text-primary"><i class="fa fa-cogs mr-2"></i>SPECIAL WARRANTY TERMS & CONDITIONS (PRODUCT WISE)</h4>
                        <b>A. Inverters</b>
                        <ol class="ml-3">
                            <li>Make sure not to connect grid power to the output of the Inverter which will damage it permanently</li>
                            <li>Make sure to use proper batteries with correct voltage. Do not use damaged or substandard batteries</li>
                            <li>Do not exceed the half (1/2) of the marked output peak wattage. For example, if you use a 5kW inverter, the maximum you can use continuously is 2.5kW. Exceeding this will make the inverter to heat up and damage the components inside.</li>
                            <li>If you don't know the subject properly, always get the installation done by a qualified technician.</li>
                            <li>Do not connect the inverter to the vehicle battery while the engine is on</li>
                        </ol>
                    </div>
                    <div class="mb-4">
                        <h4 class="text-success"><i class="fa fa-language mr-2"></i>වගකීම (Warranty in Sinhala)</h4>
                        <div class="card bg-light border-0 mb-3">
                            <div class="card-body">
                                <p>පහත සඳහන් පරිදි අප අලෙවි කරන සමහර නිෂ්පාදන සඳහා නිෂ්පාදන දෝෂවලට එරෙහිව පමණක් වගකීම් සහතිකයක් ලබා දෙන්නෙමු.</p>
                                <ul>
                                    <li>ඉලෙක්ට්රොනික මෙවලම්: මාස 6ක වගකීමක</li>
                                </ul>
                                <h5>වගකීමක් ලබා ගන්නේ කෙසේද?</h5>
                                <p>ප්රථමයෙන් ඔබ 0777820662 වෙත පහත සියලු විස්තර සඳහන් කර whatsapp පණිවිඩයක් එවිය යුතුය</p>
                                <ol>
                                    <li>ඇණවුම් රිසිට්පත් අංකය හෝ Online Order Reference</li>
                                    <li>වයර් සම්බන්ධතා රූපය (අදාළ නම් පමණි)</li>
                                    <li>වයර් සම්බන්ධ කර ඇති ආකාරය පෙන්වන ඉහළින් ගත් ඡායාරූපයක් (අදාළ නම් පමණි)</li>
                                    <li>භාණ්ඩයේ පැති දෙකම පෙන්වන පැහැදිලි ඡායාරූප දෙකක් (භාණ්ඩය ඔබ අපෙන් මිලදී ගත් තත්ත්වයෙම තිබිය  යුතුය)</li>
                                    <li>භාවිතා කළ විදුලි සැපයුම් උපකරණයේ ඡායාරූපයක් (ආදාන/ප්රතිදාන වෝල්ටීයතාව සහ ධාරාව ඇතුළත් විය යුතුය) (අදාළ නම් පමණි)</li>
                                    <li>ඔබට පෙනෙන ගැටළුව පිළිබඳ කෙටි විස්තරයක්</li>
                                    <li>ඔබගේ පුද්ගලික විස්තර *</li>
                                    <ul>
                                        <li>ඉලෙක්ට්රොනික් පිළිබඳ දැනුම: හොඳ / සාමාන්ය / අඩු (අදාළ නම් පමණි)</li>
                                        <li>Embedded Systems පිළිබඳ දැනුම: හොඳ / සාමාන්ය / අඩු (අදාළ නම් පමණි)</li>
                                        <li>ඔබගේ දුරකථන අංකය:</li>
                                    </ul>
                                </ol>
                                <p>ඉහත සියලු තොරතුරු සැපයූ පසු ඔබට online උදව් කිරීමට හැකියාවක් අපට නොපෙනේ නම්,  ඔබට ලියාපදිංචි තැපෑලෙන් හෝ කුරියර් සේවාවක් හරහා භාණ්ඩය අප වෙත එවිය හැකිය. එසේ එවන විට මොඩියුලය නිවැරදිව ඇසුරුම් කර, ඔබේ නම, දුරකථන අංකය, විද්යුත් තැපැල් ලිපිනය සහ බිල් අංකය සමඟ සටහනක් ඇතුළත් කර අදාළ ගාස්තු සියල්ල ගෙවා අප වෙත එවිය යුතුය. අපගේ සුදුසුකම් ලත් ඉංජිනේරු කණ්ඩායම විමර්ශනයක් සිදු කර ඔවුන්ගේ සොයාගැනීම් ඔබට දැනුම් දෙනු ඇත. මෙම ක්රියාවලිය සති අන්ත, වෙළඳ නිවාඩු සහ ගමන් සීමා කිරීමේ වේලාවන් හැර වැඩ කරන දින 10ක් දක්වා ගත වේ.</p>
                                <h5>නිතර අසනු ලබන ප්රශ්න කිහිපයකට පිළිතුරු පහත දැක්වේ.</h5>
                                <ol>
                                    <li>දෝෂ සහිත අයිතම(ය) පරීක්ෂා කිරීම සඳහා ඔබ භාර දිය යුත්තේ කොතැනටද? ලියාපදිංචි තැපෑලෙන් හෝ කුරියර් සේවාවක් හරහා භාණ්ඩය අප වෙත එවිය හැකිය<br>Delimach Lanka (pvt) Ltd<br>555/22, Ranmuthugala<br>Kadawatha</li>
                                    <li>දෝෂ සහිත අයිතම(ය) ලියාපදිංචි තැපෑල හරහා හෝ කුරියර් සේවාවක් හරහා එවීමට ගාස්තුව ඔබ විසින් ගෙවිය යුතුද? ඔව්, ආරක්ෂිතව භාණ්ඩ ඇසුරුම් කර, සියලු ගාස්තු ගෙවා අප වෙත එවිය යුතුය</li>
                                    <li>ඔබ වැරදි ලෙස භාවිතා කිරීම නිසා එය පුළුස්සා ඇති බව අපට පෙනී ගියහොත් කුමක් සිදුවේද? වැරදි සම්බන්ධතාවය, ස්ථිරාංග යාවත්කාලීන කිරීම හෝ වෙනත් පරිශීලක ක්රියාකාරකම් හේතුවෙන් මොඩියුලය පුළුස්සා ඇත්නම්, අපි ඔබට ඒ පිළිබඳ වාර්තාවක් ලබා දෙන ඇත</li>
                                    <li>නිෂ්පාදන දෝෂයක් සොයා ගන්නේ නම් කුමක් සිදුවේද? ඔබට විකල්ප දෙකක් තිබේ. එකක් ආපසු ගෙවීමක් ඉල්ලා සිටීම සහ අනෙක ආදේශකයක් ඉල්ලා සිටීමයි. ආදේශකය කුරියර් සේවාව හරහා එවිය හැක.</li>
                                </ol>
                                <h5>වගකීම් නියමයන් සහ කොන්දේසි</h5>
                                <p>පහත සඳහන් කොන්දේසි එකක් හෝ කිහිපයක් සපුරා ඇත්නම් වගකීම අවලංගු වේ</p>
                                <ol>
                                    <li>කෙටි පරිපථයක් නිසා ඇතිවන පිළිස්සුම් ලකුණු</li>
                                    <li>බලයලත් පුද්ගලයින් විසින් සිදු නොකළ ඕනෑම වෙනස් කිරීමක්</li>
                                    <li>නුසුදුසු ස්ථානයක සවිකිරිම හෝ භාවිතා කිරීම</li>
                                    <li>නොසැලකිල්ල හෝ නුසුදුසු භාවිතය</li>
                                    <li>බාහිර සිදුවීම (අධි වෝල්ටීයතාවය, අනෙකුත් උපකරණ වල බලපැමෙන් අපගේ ඒකකය අසාර්ථක වීම, ආදිය)</li>
                                    <li>නඩත්තුව ඇතුළුව ලේඛන පිළිනොපැදීම</li>
                                    <li>අකුණු සැර, බල වැඩිවීම්, ස්වභාවික විපත්, සහ ලැව්ගිනි වැනි ස්වභාවික අනතුරු</li>
                                    <li>විශ්ලේෂණයෙන් පසු කිසිදු වරදක් නොපෙන්වීම</li>
                                    <li>ආරක්ෂිත රෙගුලාසි නොයෙදීම</li>
                                    <li>ලේඛන මගින් අවසර නොලබන උපකරණ, අයිතම හෝ ද්රව්ය සමඟ ඒකාබද්ධව භාවිතා කිරීම</li>
                                </ol>
                                <h5>විශේෂ වගකීම් නියමයන් සහ කොන්දේසි (නිෂ්පාදන අනුව)</h5>
                                <b>A. ඉන්වර්ටර්</b>
                                <ol>
                                    <li>ඉන්වර්ටරයේ ප්රතිදානය ස්ථිරවම හානි කරන ජාලක බලය සම්බන්ධ නොකිරීමට වග බලා ගන්න</li>
                                    <li>නිවැරදි වෝල්ටීයතාවය සහිත නිසි බැටරි භාවිතා කිරීමට වග බලා ගන්න. හානියට පත් හෝ බාල බැටරි භාවිතා නොකරන්න</li>
                                    <li>සලකුණු කරන ලද නිමැවුම් උපරිම වොට් එකෙන් අඩක් (1/2) නොඉක්මවන්න. උදාහරණයක් ලෙස, ඔබ 5kW ඉන්වර්ටරයක් භාවිතා කරන්නේ නම්, ඔබට අඛණ්ඩව භාවිතා කළ හැකි උපරිමය 2.5kW වේ. මෙය ඉක්මවා ගියහොත් ඉන්වර්ටරය රත් වී එහි ඇති කොටස් වලට හානි වේ.</li>
                                    <li>ඔබ විෂය නිසි ලෙස නොදන්නේ නම්, සෑම විටම සුදුසුකම් ලත් කාර්මික ශිල්පියෙකු ලවා ස්ථාපනය සිදු කරගන්න.</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
