<!--Breadcrumb Area-->
<section class="breadcrumb-area banner-2">
    <div class="text-block">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 v-center">
                    <div class="bread-inner">
                        <div class="bread-menu">
                            <ul>
                                <li><a href="<?= $this->Url->build(['controller' => 'Home', 'action' => 'index']) ?>">Home</a></li>
                                <li><a href="#">Blogs</a></li>
                            </ul>
                        </div>
                        <div class="bread-title">
                            <h2>Blogs</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--End Breadcrumb Area-->

<section class="blog-page pad-tb pt40">
    <div class="container">

        <div class="row">
            
            <?php foreach ($blogs as $key => $value): ?>
                <div class="col-lg-4 mt60">
                    <div class="single-blog-post- shdo">
                        <div class="single-blog-img-">
                            <a href="<?= $this->Url->build(['controller' => 'Home', 'action' => 'index', $value['url_slug']]) ?>">
                                <?php if (isset($value['media']['id'])): ?>
                                    <img src="<?= $this->request->getAttribute('webroot') ?><?= $value['media']['directory'] ?><?= $value['media']['value'] ?>" alt="girl" class="img-fluid">
                                <?php else: ?>
                                    <?= $this->Html->image('no-image.png', ['alt' => $value['title']]) ?>
                                <?php endif; ?>
                            </a>
                            <div class="entry-blog-post dg-bg2">
                                <span class="bypost-"><a href="#"><i class="fas fa-tag"></i> Technology</a></span>
                                <span class="posted-on-">
                                    <a href="#"><i class="fas fa-clock"></i> <?= date('M d, Y', strtotime($value['created_at'])) ?></a> <!-- Sep 23, 2020 -->
                                </span>
                            </div>
                        </div>
                        <div class="blog-content-tt">
                            <div class="single-blog-info-">
                                <h4><a href="<?= $this->Url->build(['controller' => 'Blogs', 'action' => 'view', $value['url_slug']]) ?>"><?= $value['title'] ?></a></h4>
                                <p><?= $value['short_description'] ?></p>
                            </div>
                            <div class="post-social">
                                <div class="ss-inline-share-wrapper ss-hover-animation-fade ss-inline-total-counter-left ss-left-inline-content ss-small-icons ss-with-spacing ss-circle-icons ss-without-labels">
                                    <div class="ss-inline-share-content">
                                        <div class="ss-social-icons-container">
                                            <a href="javascript:void(0)">Shares</a>
                                            <a href="javascript:void(0)" target="blank"><i class="fab fa-facebook"></i></a>
                                            <a href="javascript:void(0)" target="blank"><i class="fab fa-twitter"></i></a>
                                            <a href="javascript:void(0)" target="blank"><i class="fab fa-linkedin"></i></a>
                                            <a href="javascript:void(0)" target="blank"><i class="fas fa-envelope"></i></a>
                                            <a href="javascript:void(0)" target="blank"><i class="fab fa-facebook-messenger"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            
            

            
            


        </div>

    </div>
</section>