@extends('frontend.layouts.app')
@section('content')
    <main>
        <!-- ================= HERO SECTION ================= -->
        <section class="hero-section">
            <div class="container">
                <div class="hero-card">
                    <h1 class="hero-title">
                        K-12 Meal Pattern Compliance made Simple
                    </h1>

                    <p class="hero-subtitle">
                        CN Labels and Product Formulation Statements in one place. Browse thousands of products for
                        free,
                        then upgrade to download crediting documents and generate compliance reports.
                    </p>

                    <div class="hero-buttons">
                        <button class="btn btn-primary-custom">Start Now</button>
                        <button class="outline">Learn More →</button>
                    </div>
                </div>
            </div>
            <div class="demo-card">
                <img src="assets/images/hero-img.svg" class="img-fluid" alt="">
            </div>
        </section>
        <!-- FEATURES SECTION -->
        <section class="features-section">
            <div class="container">
                <div class="features-bg">
                    <!-- Heading -->
                    <div class="row align-items-center mb-5">
                        <div class="col-lg-7">
                            <h2 class="features-section-title">
                                Everything You Need for Meal Pattern Compliance
                            </h2>
                        </div>

                        <div class="col-lg-5">
                            <p class="section-desc">
                                Streamline your nutrition program management with powerful tools designed for district
                                administrators
                            </p>
                        </div>
                    </div>

                    <!-- TOP FEATURE CARDS -->
                    <div class="row featured-card-bg mb-4">

                        <!-- Card 1 -->
                        <div class="col-lg-6">
                            <div class="feature-card large-card mt-2">
                                <div class="badge-tag">
                                    <a href="#" class="heart-icon"><i class="bi bi-suit-heart"></i></a>
                                    <span class="badge-tag pro">Pro Standards & Enterprise</span>
                                </div>
                                <h5>Meal Debt Recovery</h5>
                                <p>
                                    Recover outstanding meal balances while treating every family
                                    with dignity & compassion — every dollar goes back into programs.
                                </p>
                                <!-- <div class="featured-learn-more-btn"> -->
                                <a href="#" class="learn-btn">Learn More →</a>
                                <!-- </div> -->
                            </div>
                        </div>

                        <!-- Card 2 -->
                        <div class="col-lg-6">
                            <div class="feature-card large-card  mt-2">

                                <div class="badge-tag">
                                    <a href="#" class="heart-icon"><i class="bi bi-download"></i></a>
                                    <span class="badge-tag pro">Pro Standards & Enterprise</span>
                                </div>
                                <h5>Data Export</h5>
                                <p>
                                    Export nutrition data, compliance documents, and product
                                    information seamlessly with your existing software.
                                </p>
                                <a href="#" class="learn-btn">Learn More →</a>
                            </div>
                        </div>

                    </div>

                    <!-- SMALL FEATURE GRID -->
                    <div class="row g-4">
                        <!-- Repeatable Card -->
                        <div class="col-lg-4 col-md-6">
                            <div class="feature-card small-card">
                                <div class="icon-box">
                                    <i class="bi bi-suit-heart"></i>
                                </div>
                                <h6>Product Repository</h6>
                                <p>Access a comprehensive database of products with nutrition information.</p>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <div class="feature-card small-card">
                                <div class="icon-box">
                                    <i class="bi bi-suit-heart"></i>
                                </div>
                                <h6>Report Generation</h6>
                                <p>Generate detailed reports for audits and compliance tracking.</p>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <div class="feature-card small-card">
                                <div class="icon-box">
                                    <i class="bi bi-suit-heart"></i>
                                </div>
                                <h6>Flexible Pricing</h6>
                                <p>Plans designed to scale with your district's needs.</p>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <div class="feature-card small-card">
                                <div class="icon-box">
                                    <i class="bi bi-suit-heart"></i>
                                </div>
                                <h6>Buy American Provision</h6>
                                <p>Ensure compliance with federal meal program requirements.</p>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <div class="feature-card small-card">
                                <div class="icon-box">
                                    <i class="bi bi-suit-heart"></i>
                                </div>
                                <h6>Automatic Notifications</h6>
                                <p>Get alerts about regulation updates and document changes.</p>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <div class="feature-card small-card">
                                <div class="icon-box">
                                    <i class="bi bi-suit-heart"></i>
                                </div>
                                <h6>Point of Contact</h6>
                                <p>Your single source for all things related to meal pattern compliance.</p>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </section>

        <!-- ================= STATS SECTION ================= -->
        <section class="stats-section">
            <div class="container text-center">
                <div class="features-bg">

                    <!-- Heading -->
                    <h2 class="stats-title mb-5">
                        Discover what we did for other districts
                    </h2>

                    <div class="row justify-content-center">

                        <!-- Stat 1 -->
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div class="stat-box">
                                <!-- <h3 class="stat-number">22.5k</h3> -->
                                <span id="count1" class="display-4"></span><span class="display-4">k</span>
                                <p class="stat-text">Higher Conversion Rates</p>
                            </div>
                        </div>

                        <!-- Stat 2 -->
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div class="stat-box">
                                <!-- <h3 class="stat-number">99%</h3> -->
                                <span id="count2" class="display-4"></span>
                                <span class="display-4">%</span>
                                <p class="stat-text">Higher Conversion Rates</p>
                            </div>
                        </div>

                        <!-- Stat 3 -->
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div class="stat-box">
                                <!-- <h3 class="stat-number">100+</h3> -->
                                <span id="count3" class="display-4"></span>
                                <span class="display-4">+</span>
                                <p class="stat-text">Higher Conversion Rates</p>
                            </div>
                        </div>

                        <!-- Stat 4 -->
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div class="stat-box">
                                <!-- <h3 class="stat-number">400</h3> -->
                                <span id="count4" class="display-4"></span>
                                <p class="stat-text">Higher Conversion Rates</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>

        <!-- ================= PRICING ================= -->
        <section class="pricing-tabs-section">

            <div class="container text-center">

                <h2 class="pricing-title">Simple, Transparent Pricing</h2>
                <p class="pricing-subtitle">
                    Start browsing products immediately with Pro Free.Upgrade when you're ready for full compliance
                    tools.
                </p>

                <!-- TAB BUTTONS -->
                <ul class="nav nav-pills justify-content-center pricing-tabs mb-5" id="pricingTab">
                    <li class="nav-item">
                        <button class="nav-link active" data-bs-toggle="pill" data-bs-target="#monthly">Monthly</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="pill" data-bs-target="#annual">Annual
                            <span class="save-text">Save 17%</span>
                        </button>
                    </li>
                </ul>

                <!-- TAB CONTENT -->
                <div class="tab-content">

                    <!-- ================= MONTHLY ================= -->
                    <div class="tab-pane fade show active" id="monthly">

                        <div class="row justify-content-center align-items-stretch g-4">

                            <!-- FREE -->
                            <div class="col-lg-4 col-md-6 d-flex">
                                <div class="price-card free border-green w-100">
                                    <div class="plan-head green">FREE FOREVER</div>
                                    <div class="price-body">
                                        <span class="plan-tag">Pro Free</span>
                                        <div class="pro-text">
                                            <p>Perfect for exploring our database</p>
                                        </div>
                                        <div class="forever-boder">
                                            <h2 class="mt-4">$0</h2>
                                            <p>Forever free</p>
                                        </div>

                                        <ul class="forever-checks">
                                            <li>Browse all products in our database</li>
                                            <li>View complete nutritional information</li>
                                            <li>Save up to 50 products</li>
                                            <li>View product details & specs</li>
                                            <li>Manufacturer information</li>
                                            <li>Basic search functionality</li>
                                        </ul>

                                        <button class="btn btn-dark w-100 price-btn">
                                            Get Started Free
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- MOST POPULAR -->
                            <div class="col-lg-4 col-md-6 d-flex">
                                <div class="price-card  border-orange w-100">
                                    <div class="plan-head orange">MOST POPULAR</div>
                                    <div class="price-body">

                                        <span class="plan-tag">Pro Standard</span>
                                        <div class="pro-text">
                                            <p>Complete compliance toolkitfor your nutrition program</p>
                                        </div>
                                        <div class="forever-boder">
                                            <h2 class="mt-4">$99</h2>
                                            <p>Per Month</p>
                                        </div>
                                        <h6 class="core-head">Core Features:</h6>
                                        <ul>
                                            <li>Unlimited CN label downloads</li>
                                            <li>Unlimited PFS downloads</li>
                                            <li>Complete nutritional data forevery product</li>
                                            <li>Unlimited compliance report
                                                generation</li>
                                            <li>Unlimited document requests</li>
                                            <li>Advanced search & filtering</li>
                                            <li>Document update
                                                notifications</li>
                                            <li>Export to spreadsheet (Excel/CSV)</li>
                                            <li>Multi-user access (3 seats)</li>
                                            <li>Priority email support</li>
                                            <li>Invoice payment available (NET 30)</li>
                                        </ul>

                                        <!-- <button class="btn btn-primary w-100">
                                            Subscribe Now
                                        </button> -->
                                        <div class="plus-wrapper">
                                            <p class="plus-title">PLUS:</p>
                                            <div class="plus-box orange">
                                                <div class="plus-icon">
                                                    <i class="fa-regular fa-gem"></i>
                                                </div>

                                                <div class="plus-content">
                                                    <h6>Apex K-12 Debt Recovery</h6>
                                                    <small>Up to $10,000 managed + 0% of recovered funds</small>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn subscribe-btn w-100 mt-3">
                                            Subscribe Now
                                        </button>

                                    </div>
                                </div>
                            </div>

                            <!-- PREMIUM -->
                            <div class="col-lg-4 col-md-6 d-flex">
                                <div class="price-card premium border-purple w-100">
                                    <div class="plan-head purple">PREMIUM</div>

                                    <div class="price-body">
                                        <span class="plan-tag">Pro Standard</span>
                                        <div class="pro-text">
                                            <p>Complete compliance toolkitfor your nutrition program</p>
                                        </div>
                                        <div class="forever-boder">
                                            <h2 class="mt-4">$99</h2>
                                            <p>Per Month</p>
                                        </div>
                                        <h6 class="core-head">Core Features:</h6>
                                        <ul>
                                            <li>Unlimited CN label downloads</li>
                                            <li>Unlimited PFS downloads</li>
                                            <li>Complete nutritional data forevery product</li>
                                            <li>Unlimited compliance report
                                                generation</li>
                                            <li>Unlimited document requests</li>
                                            <li>Advanced search & filtering</li>
                                            <li>Document update
                                                notifications</li>
                                            <li>Export to spreadsheet (Excel/CSV)</li>
                                            <li>Multi-user access (3 seats)</li>
                                            <li>Priority email support</li>
                                            <li>Invoice payment available (NET 30)</li>
                                        </ul>
                                        <div class="plus-wrapper">
                                            <p class="plus-title">PLUS:</p>
                                            <div class="plus-box purple">
                                                <div class="plus-icon">
                                                    <i class="fa-regular fa-gem"></i>
                                                </div>

                                                <div class="plus-content">
                                                    <h6>Apex K-12 Debt Recovery</h6>
                                                    <small>Up to $10,000 managed + 0% of recovered funds</small>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn subscribe-btn purple-btn w-100 mt-3">
                                            Subscribe Now
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="manage">
                            <p>Managing complex programs with extensive needs? <span> <b> Contact us for custom Pro
                                        Enterprise Plus solutions</b></span></p>
                        </div>
                    </div>


                    <!-- ================= ANNUAL ================= -->
                    <div class="tab-pane fade" id="annual">

                        <div class="row justify-content-center g-4">

                            <!-- Just price change -->
                            <div class="col-lg-4 col-md-6">
                                <div class="price-card free">
                                    <div class="plan-head green">FREE FOREVER</div>
                                    <div class="price-body">
                                        <h2>$0</h2>
                                        <p>Forever free</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6">
                                <div class="price-card popular">
                                    <div class="plan-head orange">MOST POPULAR</div>
                                    <div class="price-body">
                                        <h2>$84</h2>
                                        <p>Per Month (Billed Yearly)</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6">
                                <div class="price-card premium">
                                    <div class="plan-head purple">PREMIUM</div>
                                    <div class="price-body">
                                        <h2>$149</h2>
                                        <p>Per Month (Billed Yearly)</p>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </section>

        <!-- ================= FEATURES SUMMARY ================= -->
        <section class="rewards-section py-5">
            <div class="container">
                <div class="rewards-box">

                    <div class="row align-items-center g-4">

                        <!-- LEFT CONTENT -->
                        <div class="col-lg-4">
                            <!-- <span class="badge-label">Limited Time Offer</span> -->
                            <div class="badge-tag">
                                <a href="#" class="heart-icon"><i class="fa-solid fa-gift"></i></a>
                                <span class="badge-tag pro">Limited Time Offer</span>
                            </div>
                            <h3 class="section-title mt-2">Pro + Rewards</h3>
                            <p class="section-text">
                                Earn $100 for every district you refer! Share Meal Pattern Pro with your network and get
                                rewarded.
                            </p>

                            <a href="#" class="learn-btn">Learn More →</a>
                        </div>

                        <!-- FEATURES -->
                        <div class="col-lg-8">
                            <div class="row g-3">

                                <div class="col-md-6">
                                    <div class="reward-card">
                                        <span class="icon-box"><i class="bi bi-suit-heart"></i></span>
                                        <h6>$100 Per Referral</h6>
                                        <p>Earn bonuses for each district that subscribes.</p>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="reward-card">
                                        <span class="icon-box"><i class="bi bi-suit-heart"></i></span>
                                        <h6>No Limits</h6>
                                        <p>No cap on how much you can earn.</p>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="reward-card">
                                        <span class="icon-box"><i class="bi bi-suit-heart"></i></span>
                                        <h6>Your Choice</h6>
                                        <p>Choose how rewards are paid.</p>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="reward-card">
                                        <span class="icon-box"><i class="bi bi-suit-heart"></i></span>
                                        <h6>Unlimited Time</h6>
                                        <p>No expiration for referrals.</p>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>



        <!--====== hOW IT WORKS ========= -->
        <section class="how-section py-5">
            <div class="container">
                <div class="how-box text-center">

                    <h3 class="section-title">How It Works</h3>
                    <p class="section-text mb-5">
                        Start browsing products immediately with Pro Free.Upgrade when you're ready for full compliance
                        tools.
                    </p>

                    <div class="row g-4">

                        <div class="col-md-3 col-sm-1">
                            <div class="step-card">
                                <div class="step-icon">1</div>
                                <h6>Subscribe</h6>
                                <p>Select your plan.</p>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-1">
                            <div class="step-card">
                                <div class="step-icon">2</div>
                                <h6>Share With Others</h6>
                                <p>Invite districts.</p>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-1">
                            <div class="step-card">
                                <div class="step-icon">3</div>
                                <h6>They Subscribe</h6>
                                <p>You earn rewards.</p>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-1">
                            <div class="step-card">
                                <div class="step-icon">4</div>
                                <h6>Choose Reward</h6>
                                <p>Select payout option.</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>

        <!-- ======== READY TO SIMPLIFY =====  -->
        <section class="cta-section py-5">
            <div class="container">
                <div class="cta-box d-flex justify-content-between align-items-center flex-wrap">

                    <div>
                        <div class="badge-tag">
                            <a href="#" class="heart-icon"><i class="bi bi-suit-heart"></i></a>
                            <span class="badge-tag pro">Free to get started</span>
                        </div>
                        <h3 class="section-title mt-4">
                            Ready to Simplify Your Compliance?
                        </h3>
                        <p class="ready-text">
                            Join schools across the country using Meal Pattern Pro to streamlinetheir nutrition
                            programs
                        </p>
                    </div>

                    <a href="#" class="btn btn-cta">
                        Get Started for Free →
                    </a>

                </div>
            </div>
        </section>





    </main>
@endsection