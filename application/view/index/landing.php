<style>

.landing,
h1,
h2,
h3,
h4,
h5,
h6 {
    font-weight: 700;
}    
    
.container {
    width: auto;
    width: 80%;
    padding-right: 15px;
    padding-left: 15px;
}
    
.topnav {
    font-size: 14px; 
}

.lead {
    font-size: 18px;
    font-weight: 400;
}

.intro-header {
    padding-top: 50px; /* If you're making other pages, make sure there is 50px of padding to make sure the navbar doesn't overlap content! */
    padding-bottom: 50px;
    text-align: center;
    color: #f8f8f8;
    background: url(<?= Config::get('URL') ?>img/landing-texture-1.png) repeat scroll 0% 0%;
}

.intro-message {
    position: relative;
    padding-top: 20%;
    padding-bottom: 20%;
}

.intro-message > h1 {
    margin: 0;
    text-shadow: 2px 2px 3px rgba(0,0,0,0.6);
    font-size: 5em;
}

.intro-divider {
    width: 400px;
    border-top: 1px solid #f8f8f8;
    border-bottom: 1px solid rgba(0,0,0,0.2);
}

.intro-message > h3 {
    text-shadow: 2px 2px 3px rgba(0,0,0,0.6);
}

@media(max-width:767px) {
    .intro-message {
        padding-bottom: 15%;
    }

    .intro-message > h1 {
        font-size: 3em;
    }

    ul.intro-social-buttons > li {
        display: block;
        margin-bottom: 20px;
        padding: 0;
    }

    ul.intro-social-buttons > li:last-child {
        margin-bottom: 0;
    }

    .intro-divider {
        width: 100%;
    }
}

.network-name {
    text-transform: uppercase;
    font-size: 14px;
    font-weight: 400;
    letter-spacing: 2px;
}

.content-section-a {
    padding: 50px 0;
    background-color: #f8f8f8;
}

.content-section-b {
    padding: 50px 0;
    border-top: 1px solid #e7e7e7;
    border-bottom: 1px solid #e7e7e7;
}

.section-heading {
    margin-bottom: 30px;
}

.section-heading-spacer {
    float: left;
    width: 200px;
    border-top: 3px solid #e7e7e7;
}

.banner-landing {
    padding: 100px 0;
    color: #f8f8f8;
    background: url(<?= Config::get('URL') ?>img/landing-texture-1.png) repeat scroll 0% 0%;
}

.banner-landing h2 {
    margin: 0;
    text-shadow: 2px 2px 3px rgba(0,0,0,0.6);
    font-size: 3em;
}

.banner-landing ul {
    margin-bottom: 0;
}

.banner-social-buttons {
    float: right;
    margin-top: 0;
}

@media(max-width:1199px) {
    ul.banner-social-buttons {
        float: left;
        margin-top: 15px;
    }
}

@media(max-width:767px) {
    .banner-landing h2 {
        margin: 0;
        text-shadow: 2px 2px 3px rgba(0,0,0,0.6);
        font-size: 3em;
    }

    ul.banner-social-buttons > li {
        display: block;
        margin-bottom: 20px;
        padding: 0;
    }

    ul.banner-social-buttons > li:last-child {
        margin-bottom: 0;
    }
}

p.copyright {
    margin: 15px 0 0;
}
</style>
<title>RP Interface</title>
<!-- Schema.org markup for Google+ -->
<meta itemprop="name" content="RP Interface">
<!-- Open Graph data -->
<meta property="og:title" content="RP Interface"/>
<meta property="og:image" content="<?= Config::get('URL').'img/rpimage.png' ?>"/>
<!-- Twitter Card data -->
<meta name="twitter:card" content="summary_large_image"/>
<meta name="twitter:image:src" content="<?= Config::get('URL').'img/rpimage.png' ?>"/>
</head>

<body class="body-profile">
    <?php $this->renderNavbar(); ?>
    <div style="padding: 0px;" class="landing col-xl-24 col-lg-24 col-md-24 col-sm-24 col-xs-24">
        <a name="about"></a>
        <div class="intro-header">
            <div class="container">
                <div class="row">
                    <div class="col-lg-24">
                        <div class="intro-message">
                            <h1><?= $this->Text->get('LANDING_HEADER') ?></h1>
                            <h3><?= $this->Text->get('LANDING_SUB') ?></h3>
                            <hr class="intro-divider">
                            <ul class="list-inline intro-social-buttons">
                                <li>
                                    <a href="#about" class="btn btn-primary btn-lg"><i class="fa fa-book fa-fw"></i> <span class="network-name"><?= $this->Text->get('LANDING_ABOUT_BUTTON') ?></span></a>
                                </li>
                                <li>
                                    <a href="#services" class="btn btn-primary btn-lg"><i class="fa fa-puzzle-piece fa-fw"></i> <span class="network-name"><?= $this->Text->get('LANDING_SERVICES_BUTTON') ?></span></a>
                                </li>
                                <li>
                                    <a href="#contact" class="btn btn-primary btn-lg"><i class="fa fa-at fa-fw"></i> <span class="network-name"><?= $this->Text->get('LANDING_CONTACT_BUTTON') ?></span></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <a  name="services"></a>
        <div class="content-section-a">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 col-sm-12">
                        <hr class="section-heading-spacer">
                        <div class="clearfix"></div>
                        <h2 class="section-heading"><?= $this->Text->get('LANDING_H1_HEADER') ?></h2>
                        <p class="lead"><?= $this->Text->get('LANDING_H1_TEXT') ?></p>
                    </div>
                    <div class="col-lg-10 col-lg-offset-4 col-sm-12">
                    </div>
                </div>
            </div>
        </div>
        <div class="content-section-b">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 col-lg-offset-2 col-sm-push-12  col-sm-12">
                        <hr class="section-heading-spacer">
                        <div class="clearfix"></div>
                        <h2 class="section-heading"><?= $this->Text->get('LANDING_H2_HEADER') ?></h2>
                        <p class="lead"><?= $this->Text->get('LANDING_H2_TEXT') ?></p>
                    </div>
                    <div class="col-lg-10 col-sm-pull-12 col-sm-12">
                    </div>
                </div>
            </div>
        </div>
        <div class="content-section-a">
             <div class="container">
                 <div class="row">
                     <div class="col-lg-10 col-sm-12">
                         <hr class="section-heading-spacer">
                         <div class="clearfix"></div>
                        <h2 class="section-heading"><?= $this->Text->get('LANDING_H3_HEADER') ?></h2>
                        <p class="lead"><?= $this->Text->get('LANDING_H3_TEXT') ?></p>
                     </div>
                     <div class="col-lg-10 col-lg-offset-4 col-sm-12">
                     </div>
                 </div>
             </div>
        </div>
    
    <a  name="contact"></a>
    <div class="banner-landing">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2><?= $this->Text->get('LANDING_CONNECT_HEADER') ?></h2>
                </div>
                <div class="col-lg-12">
                    <ul class="list-inline banner-social-buttons">
                        <li>
                            <a href="https://twitter.com/rp_interface" class="btn btn-default btn-lg"><i class="fa fa-twitter fa-fw"></i> <span class="network-name">Twitter</span></a>
                        </li>
                        <li>
                            <a href="https://www.facebook.com/RPInterface" class="btn btn-default btn-lg"><i class="fa fa-facebook fa-fw"></i> <span class="network-name">Facebook</span></a>
                        </li>
                        <li>
                            <a href="http://forum.rpinterface.com" class="btn btn-default btn-lg"><i class="fa fa-dashboard fa-fw"></i> <span class="network-name">Forum</span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
    
    