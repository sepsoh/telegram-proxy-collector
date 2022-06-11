<?php
class TelegramProxyCollector{
    private $data;
	private $pointer = 0;
    public function __construct($channelUsername){
	
	
	    $channelUsername = str_replace('@','',$channelUsername);
	
	    $this->data = file_get_contents('https://t.me/s/'.$channelUsername);
	    if($this->data === false)
	        throw new Exception('Your host or server can`t connect to telegram servers');
	
	    preg_match_all('#(?<=href=")https:\/\/t(?:elegram)?\.me\/proxy\?server[^"]+#i',$this->data,$this->data);
	    
	    $this->data = array_unique(array_reverse($this->data[0]));

	}


	// Get new proxy from channel, If the proxy ends, getNewproxy() returns false
	public function getNewProxy(){
		if(count($this->data) > $this->pointer){
		$proxy = $this->data[$this->pointer];
		$this->pointer  += 1;
		return $proxy;			
		}else
		return false;
	}

	//Get all Proxies
    public function getAll(){
    	
    	return $this->data;
    }
	//Get proxies count
	public function getCount(){
	
		return count($this->data);
	}



}
