<?php
class block_faktura extends block_base {
    public function init() {
        $this->title = get_string('pluginname', 'block_faktura');
    }

    function GenerateInvoiceLink( $course ,$USER ){
        return '<a href="/blocks/faktura/GenerateInvoice.php?Course='.
        urlencode($course->fullname).
        '&Name='.
        urlencode($USER->firstname . " ". $USER->lastname).
        '&Adress='.
        urlencode($USER->address).
        '&Date='.
        urlencode($course->startdate).
        '"> '.
        $course->fullname.
        '</a> <br/> ';
    }

    public function get_content() {
        global $USER, $DB;
        if ($this->content !== null) {
          return $this->content;
        }

        if(is_siteadmin($USER)){
            $users = $DB->get_records('user');
            $contentStr = ""; 
            foreach ($users as $user){
                $contentStr .= "<h6>". $user->firstname." ".$user->lastname ."</h6>";
                $Courses = enrol_get_all_users_courses($user->id);
                foreach($Courses as $course){
                    $contentStr .= $this->GenerateInvoiceLink($course,$user);
                }
            }
            $this->content         =  new stdClass;
            $this->content->text   = $contentStr;
            return $this->content;
        }

        $Courses = enrol_get_all_users_courses($USER->id);
        $contentStr = "";


        foreach ($Courses as $course){
            $contentStr .= $this->GenerateInvoiceLink($course,$USER);
        }
    
        $this->content         =  new stdClass;
        $this->content->text   = $contentStr;
        return $this->content;
    }
}
?>