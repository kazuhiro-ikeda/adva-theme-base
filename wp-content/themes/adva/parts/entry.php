<div id="entry" class="l-contents">

    <section class="sec-form">
        <div class="inner">
            <div class="steps_form">
                <picture class="img">
                    <source media="(min-width: 751px)" srcset="<?php echo esc_url(get_template_directory_uri()); ?>/images/form/step_1@2x.png">
                    <source media="(max-width: 750px)" srcset="<?php echo esc_url(get_template_directory_uri()); ?>/images/form/step_1_s@2x.png">
                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/form/step_1@2x.png" alt="内容の入力" width="700" height="65">
                </picture>
            </div>
            <!-- /.steps_form -->

            <?php echo do_shortcode('[mwform_formkey key="96"]'); ?>

        </div><!-- /inner -->
    </section><!-- /sec-form -->



</div><!-- /.l-contents #page-id-->


<script src="<?php echo esc_url(get_template_directory_uri()); ?>/js/jquery.validate.min.js"></script>
<script>
jQuery(function($) {
    $.validator.addMethod(
        "regex",
        function(value, element, regexp) {
            var check = false;
            return this.optional(element) || regexp.test(value);
        },
    );

    //入力項目の検証ルール定義
    var rules = {
        name: {
            required: [true, 'おなまえ']
        },
        age: {
            required: [true, '年齢']
        },
        tel: {
            required: [true, '電話番号'],
            maxlength: 50,
            regex: /^(0{1}\d{1,4}-{0,1}\d{1,4}-{0,1}\d{4})$/
        },
        mail: {
            required: [true, 'メールアドレス'],
            email: true
        },
        'agree[data][]': {
            //同意チェック
            required: true,
        }
    };

    var messages = {
        'agree[data][]': {
            required: "*個人情報保護方針をお読みいただき、チェックを入れてください。"
        }
    };

    $('#mw_wp_form_mw-wp-form-96 form').validate({ //フォームID
        rules: rules,
        messages: messages,

        //フォーカスアウトでバリデーション実行
        onfocusout: function(element) {
            $(element).valid();
        },
        //エラーメッセージ出力箇所調整
        errorPlacement: function(error, element) {
            if (element.attr("name") == "agree[data][]") {
                //同意ボタンの場合
                error.insertAfter("#agree_error");
            } else if (element.attr("name") == "age") {
                //年齢の場合
                error.insertAfter("#age_error");
            } else {
                //それ以外の場合はエレメントの後に表示
                error.insertAfter(element);
            }
        }
    });

    //標準エラーメッセージの変更
    $.extend($.validator.messages, {
        email: '*正しいメールアドレスの形式で入力してください',
        required: "*{1}を入力してください",
        maxlength: '最大文字数は50字です',
        regex: '電話番号（半角数字）を入力してください'
    });

})
</script>