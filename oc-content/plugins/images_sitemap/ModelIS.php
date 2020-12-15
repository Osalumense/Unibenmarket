<?php
class ModelIS extends DAO
    {
        private static $instance ;
        public static function newInstance()
        {
            if( !self::$instance instanceof self ) {
                self::$instance = new self ;
            }
            return self::$instance ;
        }

        function __construct()
        {
            parent::__construct();
        }
	
	public function getTable_Res(){
              return DB_TABLE_PREFIX.'t_item_resource';
        }
	
	public function getItemFromRes($idr)
	{
	   $this->dao->select(' fk_i_item_id ');
           $this->dao->from( $this->getTable_Res() );
	   $this->dao->where('pk_i_id', $idr );
	   $result = $this->dao->get();
	   if( $result ) {
		return $result->row();
		 }
               return array();
	   
	}

    }

?>