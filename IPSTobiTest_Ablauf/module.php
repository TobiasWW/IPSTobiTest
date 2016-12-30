<?

// Klassendefinition
class IPSTobiTest_Ablauf extends IPSModule
{
    //Zähler
    private $i      = 0;
    protected $rand = "X";

	//SVN-Client Commit Test
//var_dump(bin2hex($bytes));

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
                        $instInfo = "IS_CREATING";
                        break;
                    }
                case 102 :
                    {
                        $instInfo = "IS_ACTIVE";
                        break;
                    }
                case 103 :
                    {
                        $instInfo = "IS_DELETING";
                        break;
                    }
                case 104 :
                    {
                        $instInfo = "IS_INACTIVE";
                        break;
                    }
                default :
                    {
                        $instInfo = 'UNKNOWN (' . $inst["InstanceStatus"] . ')';
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
        $this->i++;

        return '$rand: "' . $this->rand . '" - $i: "' . $this->i . '" - Instanz #' . $this->InstanceID . ':  "' . $instInfo . '" - Kernel: "' . $kStat . '"';
    }

    public function __construct($InstanceID)
    {
        $this->rand = mt_rand(1000, 9999);

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
        
        $this->RegisterPropertyInteger("VariableID", 0);
        $this->RegisterPropertyBoolean("DummyCheckBox", false);
        
        IPS_LogMessage(__FUNCTION__ . " (Ende)", $this->getInfoText()); 
    }

    // Überschreibt die intere IPS_ApplyChanges() Funktion
    public function ApplyChanges()
    {
        IPS_LogMessage(__FUNCTION__ . " (vor Parent)", $this->getInfoText());

        // Diese Zeile nicht löschen
        parent::ApplyChanges();

        IPS_LogMessage(__FUNCTION__ . " (nach Parent)", $this->getInfoText());
        
        $id = $this->ReadPropertyInteger("VariableID");
        if ($id !== false and $id > 0)
        {
            $this->RegisterMessage($id, 10603); //Var Change
        }
        
        IPS_LogMessage(__FUNCTION__ . " (Ende)", $this->getInfoText());
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
        IPS_LogMessage(__FUNCTION__ . " (Anfang)", $this->getInfoText());

        $elements = '{ "type": "SelectVariable", "name": "VariableID", "caption": "MessageSink Variable" },';
        $elements .= '{ "type": "CheckBox", "name": "DummyCheckBox", "caption": "Dummy CheckBox" }';

        IPS_LogMessage(__FUNCTION__ . " (Ende)", $this->getInfoText());
        return '{"elements": [ ' . $elements . ' ]}';
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