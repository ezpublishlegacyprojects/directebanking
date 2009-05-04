<?php

class directeBankingChecker extends eZPaymentCallbackChecker
{
    function __construct( $iniFile )
    {
        $this->eZPaymentCallbackChecker( $iniFile );
        $this->logger = eZPaymentLogger::CreateForAdd( 'var/log/DIRECTebankingChecker.log' );    
    }
    function hashValidation()
    {
        $this->logger->writeTimedString( 'hashValidation', 'begin validation' );
        
        $data = array(
            'transaction' => $this->getFieldValue( 'transaction' ),
            'user_id' => $this->getFieldValue( 'user_id' ),
            'project_id' => $this->getFieldValue( 'project_id' ),
            'sender_holder' => $this->getFieldValue( 'sender_holder' ),
            'sender_account_number' => $this->getFieldValue( 'sender_account_number' ),
            'sender_bank_code' => $this->getFieldValue( 'sender_bank_code' ),
            'sender_bank_name' => $this->getFieldValue( 'sender_bank_name' ),
            'sender_bank_bic' => $this->getFieldValue( 'sender_bank_bic' ),
            'sender_iban' => $this->getFieldValue( 'sender_iban' ),
            'sender_country_id' => $this->getFieldValue( 'sender_country_id' ),
            'recipient_holder' => $this->getFieldValue( 'recipient_holder' ),
            'recipient_account_number' => $this->getFieldValue( 'recipient_account_number' ),
            'recipient_bank_code' => $this->getFieldValue( 'recipient_bank_code' ),
            'recipient_bank_name' => $this->getFieldValue( 'recipient_bank_name' ),
            'recipient_bank_bic' => $this->getFieldValue( 'recipient_bank_bic' ),
            'recipient_iban' => $this->getFieldValue( 'recipient_iban' ),
            'recipient_country_id' => $this->getFieldValue( 'recipient_country_id' ),
            'international_transaction' => $this->getFieldValue( 'international_transaction' ),
            'amount' => $this->getFieldValue( 'amount' ),
            'currency_id' => $this->getFieldValue( 'currency_id' ),
            'reason_1' => $this->getFieldValue( 'reason_1' ),
            'reason_2' => $this->getFieldValue( 'reason_2' ),
            'security_criteria' => $this->getFieldValue( 'security_criteria' ),
            'user_variable_0' => $this->getFieldValue( 'user_variable_0' ),
            'user_variable_1' => $this->getFieldValue( 'user_variable_1' ),
            'user_variable_2' => $this->getFieldValue( 'user_variable_2' ),
            'user_variable_3' => $this->getFieldValue( 'user_variable_3' ),
            'user_variable_4' => $this->getFieldValue( 'user_variable_4' ),
            'user_variable_5' => $this->getFieldValue( 'user_variable_5' ),
            'created' => $this->getFieldValue( 'created' ),
            'project_password' => $this->ini->variable( 'EbankingSettings', 'ProjectPWD')
        );
        
        $data_serial = implode( '|', $data );
        switch( strtolower($this->ini->variable( 'EbankingSettings', 'InputCheckType' )) )
        {
            case 'sha1':
            case 'sha256':
            case 'md5':
            {
                $hash = hash(strtolower($this->ini->variable( 'EbankingSettings', 'InputCheckType' )), $data_serial );
            }break;
            default:
            {
                $hash = hash('md5', $data_serial );
            }break;
        }
        
        if( $this->checkDataField( 'hash', $hash ) )
        {
            $this->logger->writeTimedString( 'generated Hash: '.$hash, 'submited Hash: '.$this->getFieldValue( 'hash' ) );
            return true;
        }

        $this->logger->writeTimedString( 'different hashes in hashValidation()' );
        return false;
    }
}

?>
