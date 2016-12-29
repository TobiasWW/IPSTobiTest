<?

// Klassendefinition
class IPSTobiTest_Ablauf extends IPSModule
{

    //Zähler
    private $i = 0;

    private function getInfoText()
    {
        $inst     = @IPS_GetInstance($this->InstanceID);
        $instInfo = "";
        if ($inst === false)
        {
            $instInfo = "NICHT VORHANDEN";
        }
        else
        {
            switch ($inst["InstanceStatus"])
            {
                case 101 :
                    {
                        $kStat = "IS_CREATING";
                        break;
                    }
                case 102 :
                    {
                        $kStat = "IS_ACTIVE";
                        break;
                    }
                case 103 :
                    {
                        $kStat = "IS_DELETING";
                        break;
                    }
                case 104 :
                    {
                        $kStat = "IS_INACTIVE";
                        break;
                    }
                default :
                    {
                        $kStat = 'UNKNOWN (' . $inst["InstanceStatus"] . ')';
                        break;
                    }
            }
        }

        $kStat    = "";
        $kStatInt = @IPS_GetKernelRunlevel();
        switch ($kStatInt)
        {
            case 10101 :
                {
                    $kStat = "KR_CREATE";
                    break;
                }
            case 10102 :
                {
                    $kStat = "KR_INIT";
                    break;
                }
            case 10103 :
                {
                    $kStat = "KR_READY";
                    break;
                }
            case 10104 :
                {
                    $kStat = "KR_UNINIT";
                    break;
                }
            case 10105 :
                {
                    $kStat = "KR_SHUTDOWN";
                    break;
                }
            default :
                {
                    $kStat = 'UNKNOWN (' . $kStatInt . ')';
                    break;
                }
        }
        return '$i: "' . $this->$i . '" - Instanz #' . $this->InstanceID . ':  "' . $instInfo . '" - Kernel: "' . $kStat . '"';
    }

    public function __construct($InstanceID)
    {
        IPS_LogMessage(__FUNCTION__ . " (vor Parent)", $this->getInfoText());

        // Diese Zeile nicht löschen
        parent::__construct($InstanceID);

        IPS_LogMessage(__FUNCTION__ . " (nach Parent)", $this->getInfoText());
    }

    // Überschreibt die interne IPS_Create($id) Funktion
    public function Create()
    {
        IPS_LogMessage(__FUNCTION__ . " (vor Parent)", $this->getInfoText());

        // Diese Zeile nicht löschen.
        parent::Create();

        IPS_LogMessage(__FUNCTION__ . " (nach Parent)", $this->getInfoText());
    }

    // Überschreibt die intere IPS_ApplyChanges() Funktion
    public function ApplyChanges()
    {
        IPS_LogMessage(__FUNCTION__ . " (vor Parent)", $this->getInfoText());

        // Diese Zeile nicht löschen
        parent::ApplyChanges();

        IPS_LogMessage(__FUNCTION__ . " (nach Parent)", $this->getInfoText());
    }

    public function Destroy()
    {
        IPS_LogMessage(__FUNCTION__ . " (vor Parent)", $this->getInfoText());

        parent::Destroy();

        IPS_LogMessage(__FUNCTION__ . " (nach Parent)", $this->getInfoText());
    }

    public function ForwardData($JSONString)
    {
        IPS_LogMessage(__FUNCTION__ . "", $this->getInfoText());
    }

    public function GetConfigurationForm()
    {
        IPS_LogMessage(__FUNCTION__ . "", $this->getInfoText());
    }

    public function MessageSink($TimeStamp, $SenderID, $Message, $Data)
    {
        IPS_LogMessage(__FUNCTION__ . "", $this->getInfoText());
    }

    public function ReceiveData($JSONString)
    {
        IPS_LogMessage(__FUNCTION__ . "", $this->getInfoText());
    }

    public function RequestAction($Ident, $Value)
    {
        IPS_LogMessage(__FUNCTION__ . "", $this->getInfoText());
    }

}

?>