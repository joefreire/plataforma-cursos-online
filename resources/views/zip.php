<?php
$files = array();
	foreach($materiais as $m){
            $files[] = base_path().'/public/uploads/materiais/'.$m->nome;
        }
        
        //$files = array('readme.txt', 'test.html', 'image.gif');

        $zipname = 'material-'.$aula->nome.'.zip';
        $zip = new ZipArchive;
        $zip->open(base_path().'/public/'.$zipname, ZipArchive::CREATE);
        
        foreach ($files as $file) {
            $filename = substr($file, strrpos($file, '/')+1);
            $zip->addFile($file, $filename);
        }

        $zip->close();

        header('Content-Type: application/zip');
        header('Content-disposition: attachment; filename='.$zipname);
        header('Content-Length: ' . filesize(base_path().'/public/'.$zipname));
        readfile(base_path().'/public/'.$zipname);