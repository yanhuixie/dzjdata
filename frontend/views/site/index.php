<?php
/* @var $this yii\web\View */
$this->title = Yii::$app->name;
?>
<div class="site-index">

    <?php echo \common\widgets\DbCarousel::widget([
        'key'=>'index',
        'options' => [
            'class' => 'slide', // enables slide effect
        ],
    ]) ?>

    <div class="jumbotron">
        <h2>欢迎来到龙泉大藏经数据整理平台!</h2>

    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-6">
                <h3>阙疑文字校对</h3>

                <p>阙疑文字指的是藏经中的一些生僻字，早期标注时未能找到合适的Unicode汉字对应。此次，针对这些阙疑文字，我们需要逐个去龙泉字库查找、确认。
                    按照校对的原则，尽量找到和图片中字形一致的汉字，如果没有Unicode汉字与其对应，则可以用它的正字进行替代。</p>

                <p><a class="btn btn-default" href="/tptk-error-char/check">开始 &raquo;</a></p>
            </div>
            <div class="col-lg-6">
                <h3>阙疑文字审查</h3>

                <p>阙疑文字审查指的是在阙疑文字校对的基础上，进行第二遍审查确认。</p>

                <p><a class="btn btn-default" href="/tptk-error-char/confirm">开始 &raquo;</a></p>
            </div>
        </div>

    </div>
</div>
