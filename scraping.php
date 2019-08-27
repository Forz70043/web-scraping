#!/usr/bin/php
<?php

if(php_sapi_name()!='cli') {
	die('Could not execute');
}

$VERBOSE = 0;
$argv=$_SERVER['argv'];
$argc=$_SERVER['argc'];

function usage($cmdname)
{
	fprintf(STDERR,"web scraping - with file get content \n");
	fprintf(STDERR,"Usage: %s [options] [arguments] \n",$cmdname);
	fprintf(STDERR,"options:\n");
    fprintf(STDERR,"\t-v\t\tverbose (print information about script running)\n");
    fprintf(STDERR,"arguments:\n");
    fprintf(STDERR,"\tlink\t\t link to find info\n");
    fprintf(STDERR,"\tsearch\t\t search info\n");
};

function checkUrl($url)
{
    //$url=filter_var($url,FILTER_SANITAZE_URL);
    print("\nURL: ".print_r($url,true)."\n");
    if(filter_var($url,FILTER_VALIDATE_URL))    return $url;
    
    return false;
}

function getPageFromUrl($url)
{
    if($page=@file_get_contents($url))  return $page;
    return false;
}

function findSomething($search,$page)
{
    print("\nSEARCH: ".print_r($search,true)."\n");
    //print("\nPAGE: ".print_r($page,true)."\n");

    $pattern="/^[-_@$\/]?[.]*(".$search.")[.]*[-_@$\/]?$/i";
    preg_match($pattern,$page,$matches);
    print("match: ".print_r($matches,true));
    
    return $matches;
}

//-------------------------------------------------------

if($argc<2){
    $cmdname=basename(array_shift($_SERVER['argv']));
    usage($cmdname);
    exit(1);
}

foreach($argv as $key => $value){ 
    if($value==="-v"){
        $VERBOSE=1; 
        $pos=$key+1; break;
    }
}

if($url=checkUrl($argv[($pos)?$pos:1]))
{
    if($VERBOSE) printf("Check %s ....OK\n",$url);
    if($page=getPageFromUrl($url))
    {
        if($VERBOSE){ printf("Page work in progress....OK\nStart searching now...\n"); }
        
        $matches=findSomething($argv[$argc-1],$page);

    }
}

