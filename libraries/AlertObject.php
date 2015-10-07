<?php

/* KREIRANJE KLASE AlertObject RADI EFEKTIVNIJEG KORISCENJA RAZLICITIH ALERTA */

class AlertObject
{
    public  $alert_type;
    public  $alert_show;
    public  $alert_message;

    public function AlertObject()
    {
        $this->alert_type = "";
        $this->alert_show = "none;";
        $this->alert_message = "";
    }

    public function removeAlert()
    {
        $this->alert_type = "";
        $this->alert_show = "none;";
        $this->alert_message = "";
    }

    public function setSuccessAlert($alert_message)
    {
        $this->alert_type = "alert-success";
        $this->alert_show = "block;";
        $this->alert_message = $alert_message;
    }

    public function setWarningAlert($alert_message)
    {
        $this->alert_type = "alert-warning";
        $this->alert_show = "block;";
        $this->alert_message = $alert_message;
    }

    public function setErrorAlert($alert_message)
    {
        $this->alert_type = "alert-danger";
        $this->alert_show = "block;";
        $this->alert_message = $alert_message;
    }

    public function setInfoAlert($alert_message)
    {
        $this->alert_type = "alert-info";
        $this->alert_show = "block";
        $this->alert_message = ($alert_message);
    }

}