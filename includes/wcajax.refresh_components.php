<?php

// Updates Ajax Components (Chat blocks that need to be refreshed periodically)

    if(!isset($this)) { die(); }

    $output = $this->user->getListChanges() . '[$]' . 
        $this->room->getTopicChanges() . '[$]' . 
        $this->room->getListChanges() . '[$]' . 
        (
            (
                WcTime::parseFileMTime(
                    self::$roomDir . 'hidden_' . 
                    base64_encode(WcPgc::mySession('current_room')) . '.txt'
                ) <= 
                (time()+self::$catchWindow)
            ) ? 
            $this->room->getHiddenMsg() : 
            ''
        ) . '[$]' . 
        $this->room->getNewMsgE() . '[$]' . 
        WcPgc::mySession('alert_msg') . '[$]' .
        str_replace('[$]', '', $this->room->getNewMsg())
    ;
    if(trim($output, '[$]')) { echo $output; }

    if(WcPgc::mySession('alert_msg')) { WcPgc::wcUnsetSession('alert_msg'); }

?>