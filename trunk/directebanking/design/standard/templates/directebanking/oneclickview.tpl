<div class="context-block">
    <div class="box-header">
        <div class="box-tc">
            <div class="box-ml">
                <div class="box-mr">
                    <div class="box-tl">
                        <div class="box-tr">
                            <div>
                                <h2 class="context-title">{'1-Click-Installation'|i18n('extension/directebanking/modules')}</h2>
                            </div>
                            <div class="header-mainline"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="box-ml">
        <div class="box-mr">
            <div class="box-content">
                <div class="context-attributes">
                    <p>Automatisiertes Anlegen von Kunden und Projekten</p>
                    <form method="get" action="https://www.sofortueberweisung.de/payment/createNew">
                        <!-- Kundendaten -->
                        <input type="hidden" name="user_salutation" value="1"/>
                        <input type="hidden" name="user_name1" value="{$user.contentobject.name}"/>
                        <input type="hidden" name="user_invoice_email" value="{$user.email}"/>
                        <input type="hidden" name="user_homepage" value="{concat( 'http://', ezini( 'SiteSettings', 'SiteURL' ))}"/>
                        <input type="hidden" name="user_shop_system_id" value="181"/>
                        <input type="hidden" name="user_email" value="{$user.email}"/>
                        <input type="hidden" name="user_country_id" value="DE"/>
                        <input type="hidden" name="user_language_id" value="DE"/>
                        
                        <!-- Projektdaten -->
                        <input type="hidden" name="project_name" value="eZ Publish Shop" />
                        <input type="hidden" name="project_homepage" value="{concat( 'http://', ezini( 'SiteSettings', 'SiteURL' ))}" />
                        <input type="hidden" name="project_shop_system_id" value="181" />
                        <input type="hidden" name="project_hash_algorithm" value="sha1" />
                        
                        <!-- Projekt-Einstellungen -->
                        <input type="hidden" name="projectssetting_interface_input_hash_check_enabled" value="1" />
                        <input type="hidden" name="projectssetting_project_password" value="{$password}" />
                        <input type="hidden" name="projectspaymentsetting_interface_success_link" value="{concat( 'http://', ezini('SiteSettings','SiteURL'),'shop/checkout')}"/>
                        <input type="hidden" name="projectspaymentsetting_interface_cancel_link" value="{concat( 'http://', ezini('SiteSettings','SiteURL'),'shop/basket')}"/>
                        <input type="hidden" name="projectssetting_locked_amount" value="1" />
                        <input type="hidden" name="projectssetting_locked_reason_1" value="1" />
                        <input type="hidden" name="projectspaymentsetting_interface_success_link_redirect" value="1" />
                        
                        <!-- E-Mail-Benachrichtigung -->
                        <input type="hidden" name="projectsnotification_email_activated" value="1"/>
                        <input type="hidden" name="projectsnotification_email_email" value="{$user.email}"/>
                        <input type="hidden" name="projectsnotification_email_language_id" value="DE"/>
                        
                        <!-- HTTP-Benachrichtigung -->
                        <input type="hidden" name="projectsnotification_http_activated" value="1"/>
                        <input type="hidden" name="projectsnotification_http_url" value="{concat( 'http://', ezini('SiteSettings','SiteURL'),'directebanking/notificate')}"/>
                        <input type="hidden" name="projectsnotification_http_method" value="1"/>
                        
                        <input type="hidden" name="backlink" value="{'/directebanking/oneclickinstallation/register'|ezurl('no','full')}" />
                        <input type="hidden" value="0" name="debug" />
                        <input type="submit" value="{'create new'|i18n('extension/directebanking/modules')}" />
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="controlbar">
        <div class="box-bc">
            <div class="box-ml">
                <div class="box-mr">
                    <div class="box-tc">
                        <div class="box-bl">
                            <div class="box-br">
                                &nbsp;
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
