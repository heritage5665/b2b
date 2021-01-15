@extends('inner')
@section('main')

<section class="breadcrumb-section small-sec flight-sec pt-0">
    <img src="/assets/images/flights/flight-breadcrumb2.jpg" class="bg-img img-fluid blur-up lazyload" alt="">
    <div class="content-bottom">
        <div class="container">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class="theme-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item"><a href="/flight-tickets/list">flights</a></li>
                            <li class="breadcrumb-item active">booking successful</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="bg-inner section-b-space success-section">
        <div class="container">
            <div class="animation">
                <svg class="animation__cloud--back" viewBox="0 0 45 18" version="1.1" xmlns="http://www.w3.org/2000/svg"
                    x="0px" y="0px" width="45px" height="18px">
                    <path
                        d="M 58.88372802734375 825.155517578125 C 16.61685562133789 826.1433715820312 57.925209045410156 781.6769409179688 58.883731842041016 781.3507080078125 C 106.25779724121094 731.152099609375 169.17739868164062 692.9862670898438 226.64694213867188 694.6730346679688 C 227.2968292236328 557.091552734375 389.74322509765625 563.0558471679688 425.166748046875 635.9559326171875 C 534.7359619140625 431.2034912109375 793.6226196289062 599.6361694335938 715.956298828125 741.27392578125 C 820.5570068359375 803.94287109375 789.773193359375 826.9736328125 767.21728515625 825.1555786132812 C 394.85125732421875 825.5911865234375 359.5561218261719 823.805908203125 58.88372802734375 825.155517578125 Z"
                        transform="matrix(0.0573558509349823, 0, 0, 0.056244850158691406, -1.3596858978271484, -29.666284561157227)" />
                </svg>
                <svg class="animation__cloud--middle" viewBox="0 0 45 18" version="1.1"
                    xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="45px" height="18px">
                    <path
                        d="M 58.88372802734375 825.155517578125 C 16.61685562133789 826.1433715820312 57.925209045410156 781.6769409179688 58.883731842041016 781.3507080078125 C 106.25779724121094 731.152099609375 169.17739868164062 692.9862670898438 226.64694213867188 694.6730346679688 C 227.2968292236328 557.091552734375 389.74322509765625 563.0558471679688 425.166748046875 635.9559326171875 C 534.7359619140625 431.2034912109375 793.6226196289062 599.6361694335938 715.956298828125 741.27392578125 C 820.5570068359375 803.94287109375 789.773193359375 826.9736328125 767.21728515625 825.1555786132812 C 394.85125732421875 825.5911865234375 359.5561218261719 823.805908203125 58.88372802734375 825.155517578125 Z"
                        transform="matrix(0.0573558509349823, 0, 0, 0.056244850158691406, -1.3596858978271484, -29.666284561157227)" />
                </svg>
                <div class="animation__plane--shadow"></div>
                <svg class="animation__plane" data-name="svgi-plane" viewBox="0 0 135.67 49.55">
                    <path fill="#fff" stroke="#464646" stroke-linejoin="round" d="M74.663 45.572h-9.106z"
                        class="svgi-plane--stripe3" />
                    <path fill="#fff" stroke="#464646" stroke-linejoin="round" stroke-width="1" d="M.75 26.719h23.309z"
                        class="svgi-plane--stripe1" />
                    <path fill="#fff" stroke="#464646" stroke-linejoin="round" stroke-width="1" d="M11.23 31.82h22.654z"
                        class="svgi-plane--stripe2" />
                    <path fill="#fff" stroke="#464646" stroke-linejoin="round" stroke-width="1"
                        d="m 53.47597,24.263013 h 68.97869 c 6.17785,0 12.47074,6.758518 12.40872,8.67006 -0.05,1.537903 -5.43763,7.036166 -11.72452,7.056809 l -59.599872,0.201269 c -9.092727,0.03097 -23.597077,-5.992662 -22.178652,-11.794378 1.160348,-4.74789 7.862358,-4.13376 12.115634,-4.13376 z" />
                    <path fill="#fff" stroke="#464646" stroke-linejoin="round" stroke-width="1"
                        d="M 45.243501,24.351777 37.946312,0.952937 h 7.185155 c 15.37061,20.184725 28.402518,23.28324 28.402518,23.28324 0,0 -27.106129,-0.178562 -28.290484,0.1156 z" />
                    <path fill="#fff" stroke="#464646" stroke-linejoin="round" stroke-width="1"
                        d="m 42.699738,18.984597 h 10.627187 c 5.753726,0 5.364609,7.799958 0,7.799958 H 42.998828 c -4.96749,0 -5.574672,-7.799958 -0.29909,-7.799958 z m 33.139939,16.164502 h 29.656893 c 6.62199,0 6.49395,6.577892 0,6.577892 H 75.940707 c -8.658596,0 -8.499549,-6.35598 -0.10103,-6.577892 z m 9.693907,6.664592 h 8.86866 c 4.439332,0 4.309293,7.066099 0,7.066099 h -8.756626 z" />
                    <path fill="#fff" stroke="#464646" stroke-linejoin="round" stroke-width="1"
                        d="m 85.55159,42.447431 c 0,0 -5.282585,0.456211 -6.372912,3.263659 1.335401,2.378073 6.397919,2.528767 6.397919,2.528767 z" />
                    <path fill="#fff" stroke="#464646" stroke-linejoin="round" stroke-width="1"
                        d="m 133.68903,31.07417 h -7.01411 c -1.26938,0 -2.89286,-1.005314 -3.21496,-3.216179 h 7.50225 z" />
                    <ellipse cx="113.564" cy="29.448534" fill="#fff" stroke="#464646" stroke-linecap="square"
                        stroke-linejoin="round" stroke-width="1" rx="1.3354006" ry="1.6400863" />
                    <ellipse cx="107.56219" cy="29.448534" fill="#fff" stroke="#464646" stroke-linecap="square"
                        stroke-linejoin="round" stroke-width="1" rx="1.3354006" ry="1.6400863" />
                    <ellipse cx="101.56039" cy="29.448534" fill="#fff" stroke="#464646" stroke-linecap="square"
                        stroke-linejoin="round" stroke-width="1" rx="1.3354006" ry="1.6400863" />
                    <ellipse cx="95.558594" cy="29.448534" fill="#fff" stroke="#464646" stroke-linecap="square"
                        stroke-linejoin="round" stroke-width="1" rx="1.3354006" ry="1.6400863" />
                    <ellipse cx="89.556793" cy="29.448534" fill="#fff" stroke="#464646" stroke-linecap="square"
                        stroke-linejoin="round" stroke-width="1" rx="1.3354006" ry="1.6400863" />
                    <ellipse cx="83.554993" cy="29.448534" fill="#fff" stroke="#464646" stroke-linecap="square"
                        stroke-linejoin="round" stroke-width="1" rx="1.3354006" ry="1.6400863" />
                    <ellipse cx="77.553192" cy="29.448534" fill="#fff" stroke="#464646" stroke-linecap="square"
                        stroke-linejoin="round" stroke-width="1" rx="1.3354006" ry="1.6400863" />
                    <ellipse cx="71.551392" cy="29.448534" fill="#fff" stroke="#464646" stroke-linecap="square"
                        stroke-linejoin="round" stroke-width="1" rx="1.3354006" ry="1.6400863" />
                    <ellipse cx="65.549591" cy="29.448534" fill="#fff" stroke="#464646" stroke-linecap="square"
                        stroke-linejoin="round" stroke-width="1" rx="1.3354006" ry="1.6400863" /></svg>
                <svg class="animation__cloud--front" viewBox="0 0 45 18" version="1.1"
                    xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="45px" height="18px">
                    <path
                        d="M 58.88372802734375 825.155517578125 C 16.61685562133789 826.1433715820312 57.925209045410156 781.6769409179688 58.883731842041016 781.3507080078125 C 106.25779724121094 731.152099609375 169.17739868164062 692.9862670898438 226.64694213867188 694.6730346679688 C 227.2968292236328 557.091552734375 389.74322509765625 563.0558471679688 425.166748046875 635.9559326171875 C 534.7359619140625 431.2034912109375 793.6226196289062 599.6361694335938 715.956298828125 741.27392578125 C 820.5570068359375 803.94287109375 789.773193359375 826.9736328125 767.21728515625 825.1555786132812 C 394.85125732421875 825.5911865234375 359.5561218261719 823.805908203125 58.88372802734375 825.155517578125 Z"
                        transform="matrix(0.0573558509349823, 0, 0, 0.056244850158691406, -1.3596858978271484, -29.666284561157227)" />
                </svg>
            </div>
            <div class="row success-detail">
                <div class="col">
                    <h2>Payment Successful ! get ready to fly</h2>
                    <p>Thank you for your booking. Your PNR will be generated in 15 minutes. We will email you the ticket once PNR is generated.</p>
                    <p>For more flights please <a href="/flight-tickets/list">click here</a></p>
                </div>
            </div>
        </div>
    </section>
@stop