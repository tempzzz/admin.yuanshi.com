<?

defined('ACTION_ALIPAY') or define('ACTION_ALIPAY', 'alipay');
defined('ACTION_YEEPAY_CREDIT') or define('ACTION_YEEPAY_CREDIT', 'yeepay_credit');
defined('ACTION_YEEPAY_DEBIT') or define('ACTION_YEEPAY_DEBIT', 'yeepay_debit');
defined('ACTION_YEEPAY_CARD_MOBILE') or define('ACTION_YEEPAY_CARD_MOBILE', 'yeepay_card_mobile');
defined('ACTION_YEEPAY_CARD_GAME') or define('ACTION_YEEPAY_CARD_GAME', 'yeepay_card_game');
defined('ACTION_TENPAY') or define('ACTION_TENPAY', 'tenpay');
defined('ACTION_UPPAY') or define('ACTION_UPPAY', 'uppay');

return array(
    'PAYMENT_TYPE' => array(
        ACTION_ALIPAY=>array('name'=>'支付宝','color'=>'info'),
        ACTION_YEEPAY_CREDIT=>array('name'=>'易宝信用卡','color'=>'success'),
        ACTION_YEEPAY_DEBIT=>array('name'=>'易宝储蓄卡','color'=>'turquoise'),
        ACTION_YEEPAY_CARD_MOBILE=>array('name'=>'易宝手机充值卡','color'=>'pink'),
        ACTION_YEEPAY_CARD_GAME=>array('name'=>'易宝游戏卡','color'=>'red'),
        ACTION_TENPAY=>array('name'=>'财付通','color'=>'blue'),
        ACTION_UPPAY=>array('name'=>'银联','color'=>'turquoise')
    )
);