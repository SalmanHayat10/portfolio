<section id="hero" class="d-flex align-items-center hero-banner">
    <div class="container d-flex flex-column align-items-center aos-init aos-animate" data-aos="zoom-in"
        data-aos-delay="100">
        <h1>Hii...My Name is Salman Hayat</h1>
        <h2>I'm a professional illustrator from San Francisco</h2>
        <a href="<?= $this->Url->build(['controller' => 'Home', 'action' => 'index']) ?>#about">About Me</a>

    </div>
</section>





<!-- ======= About Section ======= -->
<section id="about" class="about">
    <h2 style="
    text-align: center;">About</h2>
    <div class="container" data-aos="fade-up">
        <div class="section-title">
            <p>I'm a Web Developer, Programmer, and Make Web Applications</p>
        </div>

        <div class="row border-top border-bottom pb-4">
            <div class="col-lg-4 pt-4 ">
                <img class="rounded-circle" style="height: 200px;width: 200px;" src="<?= $this->request->getAttribute('webroot') . $abouts['0']['media']['directory'] . $abouts['0']['media']['value'] ?>"
                    alt="ss" class="img-fluid">
             </div>
            <div class="col-lg-8 pt-4 pt-lg-0 content">
                <h3><?= $abouts['0']['short_title'] ?></h3>

                <div class="row ">
                    <div class="col-lg-6">
                        <ul>
                            <li><i class="bi bi-rounded-right"></i> <strong>BirthDate:</strong>
                                <?=date('M d, Y', strtotime($abouts['0']['birthdate'])) ?></li>
                            <li><i class="bi bi-rounded-right"></i> <strong>Phone:</strong> +91
                                <?= $abouts['0']['phone'] ?></li>
                            <li><i class="bi bi-rounded-right"></i> <strong>City:</strong>
                                 <?= $abouts['0']['city'] ?>
                            </li>
                        </ul>

                       
                    </div>
                    <div class="col-lg-6 ">
                            <ul>
                                <li><i class="bi bi-rounded-right"></i> <strong>Age: </strong>
                                    <?= $abouts['0']['age'] ?>
                                </li>
                                <li><i class="bi bi-rounded-right"></i> <strong>Degree: </strong>
                                    <?= $abouts['0']['degree'] ?></li>
                                <li><i class="bi bi-rounded-right"></i> <strong>Email:
                                    </strong><?= $abouts['0']['email'] ?>
                                </li>
                            </ul>
                        </div>
                    
                </div>
            </div>

        </div>
</section><!-- End About Section -->

<section id="skills" class="skills">
    <div class="container aos-init aos-animate" data-aos="fade-up">

        <div class="section-title">
            <h2>Skills</h2>
          
        </div>

        <div class="row skills-content">

            <div class="col-lg-6">

                <div class="progress">
                    <span class="skill">HTML <i class="val">70%</i></span>
                    <div class="progress-bar-wrap">
                        <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0"
                            aria-valuemax="70" style="width: 70%;"></div>
                    </div>
                </div>

                <div class="progress">
                    <span class="skill">CSS <i class="val">70%</i></span>
                    <div class="progress-bar-wrap">
                        <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0"
                            aria-valuemax="100" style="width: 70%;"></div>
                    </div>
                </div>

                <div class="progress">
                    <span class="skill">JavaScript <i class="val">60%</i></span>
                    <div class="progress-bar-wrap">
                        <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0"
                            aria-valuemax="100" style="width: 60%;"></div>
                    </div>
                </div>

            </div>

            <div class="col-lg-6">

                <div class="progress">
                    <span class="skill">PHP <i class="val">80%</i></span>
                    <div class="progress-bar-wrap">
                        <div class="progress-bar" role="progressbar" aria-valuenow="80" aria-valuemin="0"
                            aria-valuemax="100" style="width: 80%;"></div>
                    </div>
                </div>

                <div class="progress">
                    <span class="skill">CakePhp <i class="val">70%</i></span>
                    <div class="progress-bar-wrap">
                        <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0"
                            aria-valuemax="100" style="width: 70%;"></div>
                    </div>
                </div>

                <div class="progress">
                    <span class="skill">Software Testing <i class="val">55%</i></span>
                    <div class="progress-bar-wrap">
                        <div class="progress-bar" role="progressbar" aria-valuenow="55" aria-valuemin="0"
                            aria-valuemax="100" style="width: 55%;"></div>
                    </div>
                </div>

            </div>

        </div>

    </div>
</section>


<section id="blogs" class="blog-page pad-tb pt40 ">
    <div class="container">

        <div class="row">

            <div class="col-lg-4 mt60">
                <div class="single-blog-post- shdo">
                    <div class="single-blog-img pb-4" >
                    <?php foreach ($recent_blogs as $key => $value) : ?>

                        <a
                            href="<?= $this->Url->build(['controller' => 'Home', 'action' => 'view',$value['url_slug']]) ?>">
                            <img src="/my-portfolio/img/banner-bg.webp" alt="girl" class="img-fluid">

                        </a>
                        <?php endforeach; ?>

                    </div>
                    <div class="blog-content-tt">
                        <div class="single-blog-info-">



                            <?php foreach ($recent_blogs as $key => $value) : ?>
                            <a href="<?= $this->Url->build(['controller' => 'Home', 'action' => 'view',$value['url_slug']]) ?>">

                                <b> <?= $value['title']?>.</b>
                            </a>
                                <p><?=$value['short_description']?>..</p>

                                <?php endforeach; ?>


                        </div>
                        <div>
                            <div
                                class="ss-inline-share-wrapper ss-hover-animation-fade ss-inline-total-counter-left ss-left-inline-content ss-small-icons ss-with-spacing ss-circle-icons ss-without-labels">
                                <div class="ss-inline-share-content">
                                    <div class="header-social-links">
                                        <a href="https://twitter.com/Salmanh18680455" class="twitter"><i
                                                class="bi bi-twitter"></i></a>
                                        <a href="https://www.facebook.com/sallu.0326" class="facebook"><i
                                                class="bi bi-facebook"></i></a>
                                        <a href="https://www.instagram.com/charlie__043/" class="instagram"><i
                                                class="bi bi-instagram"></i></a>
                                        <a href="https://www.linkedin.com/in/salman-hayat-65449a232" class="linkedin"><i
                                                class="bi bi-linkedin"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="projects" class="about-agency pad-tb block-1">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 v-center">
                <div class="about-image">
                    <img src="/ascendtis-v4/img/v4-1.png" alt="about us" class="img-fluid">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="common-heading text-l ">
                    <h2>About Make-Well</h2>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                        the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley
                        of type and scrambled it to make a type specimen book. Lorem Ipsum is simply dummy text of the
                        printing and typesetting industry. Lorem Ipsum is simply dummy text of the printing and
                        typesetting industry. is simply dummy text of the printing and typesetting industry. </p>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is simply
                        dummy text of the printing and typesetting industry. is simply dummy text of the printing and
                        typesetting industry. Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                        is simply dummy text of the printing and typesetting industry.</p>
                </div>
               
            </div>
        </div>
    </div>
</section>

<!-- ======= Contact Section ======= -->
<section id="contact" class="contact">
    <div class="container" data-aos="fade-up">

        <div class="section-title">
            <h2>Contact</h2>
            <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint
                consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat
                sit in iste officiis commodi quidem hic quas.</p>
        </div>

        <!-- <div>
          <iframe style="border:0; width: 100%; height: 270px;" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12097.433213460943!2d-74.0062269!3d40.7101282!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb89d1fe6bc499443!2sDowntown+Conference+Center!5e0!3m2!1smk!2sbg!4v1539943605621" frameborder="0" allowfullscreen></iframe>
        </div> -->

        <div class="row mt-5">

            <div class="col-lg-4">
                <div class="info">
                    <div class="address">
                        <i class="bi bi-geo-alt"></i>
                        <h4>Location:</h4>
                        <p>Near Madni Masjid, Vejalpur Road, Godhra, PIN 389380</p>
                    </div>

                    <div class="email">
                        <i class="bi bi-envelope"></i>
                        <h4>Email:</h4>
                        <p>hayatsalman0326@gmail.com</p>
                    </div>

                    <div class="phone">
                        <i class="bi bi-phone"></i>
                        <h4>Call:</h4>
                        <p>+91 9638212926</p>
                    </div>

                </div>

            </div>

            <div class="col-lg-8 mt-5 mt-lg-0">

                <form method="post" role="form" class="php-email-form" onsubmit="event.preventDefault(); bookNow();">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <input type="text" name="name" class="form-control" id="input-name" placeholder="Your Name"
                                required>
                        </div>
                        <div class="col-md-6 form-group mt-3 mt-md-0">
                            <input type="email" class="form-control" name="email" id="email" placeholder="Your Email">
                        </div>
                    </div>
                    <div class="row">

                        <div class="form-group mt-3">
                            <input type="text" maxlength="10" class="form-control" name="phone" id="phone"
                                placeholder="Your Phone Number." required>

                        </div>
                    </div>

                    <div class="form-group">
                        <textarea class="form-control" id="message" name="message" rows="3"
                            placeholder="Describe your Message here!"></textarea>
                    </div>
                    <div class="text-center pt-4"><button type="submit">Send Message</button></div>

                </form>
            </div>

        </div>

    </div>
</section><!-- End Contact Section -->