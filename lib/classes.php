class contentFetcher{
    /*
    Created by: Michel Kapelle
    Created on: 31-10-2018
     */
    
    function findDivByClassName($url, $classname){
        $found='';
        $url=trim($url);
        $url = str_replace("\r", "", $url);
        $url = str_replace("\n", "", $url);
        $url = str_replace("\t", "", $url);
        $classname=trim($classname);

        $doc = new DOMDocument();
        libxml_use_internal_errors(true); //onderdruk error meldingen die ontstaan bij onjuiste HTML syntax
        $doc->loadHTMLFile($url);
        $finder = new DomXPath($doc);
        $nodes = $finder->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' $classname ')]");
        $tmp_dom = new DOMDocument();
        foreach ($nodes as $node)    {
            $tmp_dom->appendChild($tmp_dom->importNode($node,true));
        }
        $found.=trim($tmp_dom->saveHTML());
        if ($found!='' && $found!=NULL){
            return $found;
        }else{
            return 'noresult';
        }
    }

    function findDivByID($url, $divname){
        $url=trim($url);
        $url = str_replace(" ", "", $url);
        $divname=trim($divname);
        $url = str_replace("\r", "", $url);
        $url = str_replace("\n", "", $url);
        $url = str_replace("\t", "", $url);
        $url=trim($url);
        $found='';
        $doc = new DOMDocument();
        libxml_use_internal_errors(true); //onderdruk error meldingen die ontstaan bij onjuiste HTML syntax
        $doc->loadHTMLFile($url);
        $test=$doc->getElementById($divname);
        $found=$test->textContent;
        if ($found!='' && $found!=NULL){
            return $found;
        }else{
            return 'noresult';
        }
    }
    
    }
