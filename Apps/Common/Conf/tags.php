<?php
    return array(
        'app_begin' => array(//因为项目中也可能用到语言行为,最好放在项目开始的地方
            'Behavior\CheckLangBehavior'//检测语言
        )
    );