<?php

    class Page
    {
        private $_actionBtnName;
        private $_formAction;
        private $_formTitle;
        
        public function __construct($actionBtnName,$formAction,$formTitle)
        {
            $this->_actionBtnName = $actionBtnName;
            $this->_formAction = $formAction;
            $this->_formTitle = $formTitle;
        }
        
        public function setActionBtnName($actionBtnName)
        {
            $this->_actionBtnName = $actionBtnName;
        }       
        
        public function getActionBtnName()
        {
            return $this->_actionBtnName;
        }
        public function setFormAction($formAction)
        {
            $this->_formAction = $formAction;
            
        }
        public function getFormAction()
        {
            return $this->_formAction ;
            
        }
        public function setFormTitle($formTitle)
        {
            $this->_formTitle = $formTitle;
        }
        public function getFormTitle()
        {
            return $this->_formTitle;
        }
        
    
    }
?>