<div id="contact" class="l-contents">

    <div class="pageTtl">
        <div class="heading-01 heading-01--center">
            <div class="heading-01__en en">Contact</div>
            <h1 class="heading-01__ja">お問い合わせ</h1>
        </div>
    </div>

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

            <?php echo do_shortcode('[mwform_formkey key="38"]'); ?>

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
        radio_name: {
            //ラジオボタン
            required: [true, 'ラジオボタン']
        },
        select_name: {
            //セレクトボックス
            required: [true, 'セレクトボックス']
        },
        name: {
            required: [true, 'お名前']
        },
        furigana: {
            required: [true, 'ふりがな']
        },
        mail: {
            required: [true, 'メールアドレス'],
            email: true
        },
        tel: {
            required: [true, '電話番号'],
            maxlength: 50,
            regex: /^(0{1}\d{1,4}-{0,1}\d{1,4}-{0,1}\d{4})$/
        },
        zip: {
            required: [true, '郵便番号']
        },
        pref: {
            required: [true, '都道府県']
        },
        city: {
            required: [true, '市区町村']
        },
        addr: {
            required: [true, '番地・建物名']
        },
        message: {
            required: [true, 'お問い合わせ内容']
        },
        'agree[data][]': {
            //同意チェック
            required: true,
        },
        'checkbox_name[data][]': {
            //チェックボックス
            required: true
        }
    };

    var messages = {
        'agree[data][]': {
            required: "*個人情報保護方針をお読みいただき、チェックを入れてください。"
        },
        'checkbox_name[data][]': {
            required: "*該当する項目にチェックを入れてください。"
        },
        select_name: {
            required: "*該当する項目を選択してください。"
        },
        radio_name: {
            required: "*該当する項目を選択してください。"
        }
    };

    $('#mw_wp_form_mw-wp-form-38 form').validate({ //フォームID
        rules: rules,
        messages: messages,

        //フォーカスアウトでバリデーション実行
        onfocusout: function(element) {
            $(element).valid();
        },
        //エラーメッセージ出力箇所調整
        errorPlacement: function(error, element) {
            if (element.is(':radio')) {
                //ラジオボタンの場合
                error.appendTo('#js-radio-wrap');
            } else if (element.attr("name") == "checkbox_name[data][]") {
                //チェックボックスの場合
                error.appendTo('#js-checkbox-wrap');
            } else if (element.attr("name") == "agree[data][]") {
                //同意ボタンの場合
                error.insertAfter("#agree_error");
            } else {
                //それ以外の場合はエレメントの後に表示
                error.insertAfter(element);
            }
        }
    });

    //標準エラーメッセージの変更
    $.extend($.validator.messages, {
        email: '*正しいメールアドレスの形式で入力して下さい',
        required: "*{1}を入力してください",
        maxlength: '最大文字数は50字です',
        regex: '電話番号（半角数字）を入力してください'
    });

})
</script>