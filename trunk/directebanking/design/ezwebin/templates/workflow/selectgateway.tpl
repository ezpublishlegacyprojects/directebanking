
<div class="maincontentheader">
<h1>{"Select gateway"|i18n("design/standard/workflow")}</h1>
</div>

<form method="post" action={"shop/checkout"|ezurl}>
    {section name=Gateways loop=$event.selected_gateways}
        <div><input type="radio" name="SelectedGateway" value="{$Gateways:item.value}"
                {run-once}
                    checked="checked"
                {/run-once}
        />
        {if $Gateways:item.class_name|eq('directebankinggateway')}
        {$Gateways:item.Name|wash}<br />&nbsp;&nbsp;&nbsp;&nbsp;<img src="{'payment/sofortueberweisung.gif'|ezimage( no )}" style="vertical-align:middle;" />
        {elseif $Gateways:item.class_name|eq('directebankingpaycodeGateway')}
        {$Gateways:item.Name|wash}<br />&nbsp;&nbsp;&nbsp;&nbsp;<img src="{'payment/Banner_Paycode.png'|ezimage( no )}" style="vertical-align:middle;" />
        {else}
        {$Gateways:item.Name|wash}
        {/if}
        </div><br />
    {/section}
    
    <div class="buttonblock">
        <input class="defaultbutton" type="submit" name="SelectButton"  value="{'Select'|i18n('design/standard/workflow')}" />
        <input class="button"        type="submit" name="CancelButton"  value="{'Cancel'|i18n('design/standard/workflow')}" />
    </div>
</form>
