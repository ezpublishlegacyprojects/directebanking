<div class="block">
    <h1>{'Your personel Paycode'|i18n('extension/directebankingpaycode/common')}: {$paycode}</h1>
    <p>
    {'DIRECTebanking.com - paycode'|i18n('extension/directebankingpaycode/common')}<br />
    1. {'Checkout your current order'|i18n('extension/directebankingpaycode/common')}<br />
    2. {'Open sofortueberweisung.de/paycode'|i18n('extension/directebankingpaycode/common')}<br />
    3. {'Enter the following code in the text field:'|i18n('extension/directebankingpaycode/common')} <b>{$paycode}</b><br />
    4. {'Click on &quot;Start payment&quot; to start the payment procedure'|i18n('extension/directebankingpaycode/common')}<br />
    </p>
    <p><form action="{'/shop/checkout'}" method="get"><input type="submit" name="OrderIt" value="{'Click here to process your order.'|i18n('extension/directebankingpaycode/common')}" /></form></p>
</div
