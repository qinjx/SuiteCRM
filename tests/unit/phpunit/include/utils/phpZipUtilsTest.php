<?php

use SuiteCRM\Test\SuitePHPUnitFrameworkTestCase;

require_once 'include/upload_file.php';
require_once 'include/utils/php_zip_utils.php';
class php_zip_utilsTest extends SuitePHPUnitFrameworkTestCase
{
    public function testunzip()
    {
        //execute the method and test if it returns true and verify the if unzipped files exist

        $cache_dir = rtrim($GLOBALS['sugar_config']['cache_dir'], '/\\');
        $files_list = array('config.php', 'config_override.php');
        $file = $cache_dir.'/zipTest.zip';

        //creata a zip file first, to unzip
        if (!file_exists($file)) {
            zip_files_list($file, $files_list);
        }

        $result = unzip($file, $cache_dir);
        self::assertTrue($result);

        self::markTestIncomplete('File handling doesnt works in localy');
//        $this->assertFileExists($cache_dir.'/config.php');
//        $this->assertFileExists($cache_dir.'/config_override.php');

        unlink($cache_dir.'/config.php');
        unlink($cache_dir.'/config_override.php');
    }

    public function testunzip_file()
    {
        // execute the method and test if it returns true and verify the if unzipped files exist
        $cache_dir = rtrim($GLOBALS['sugar_config']['cache_dir'], '/\\');
        $files_list = array('config.php', 'config_override.php');
        $file = $cache_dir.'/zipTest.zip';

        //create a a zip file first, to unzip
        if (!file_exists($file)) {
            zip_files_list($file, $files_list);
        }

        $result = unzip_file($file, null, $cache_dir);
        self::assertTrue($result);

        self::markTestIncomplete("File handling doesn't work locally.");
//        $this->assertFileExists($cache_dir.'/config.php');
//        $this->assertFileExists($cache_dir.'/config_override.php');

        unlink($cache_dir.'/config.php');
        unlink($cache_dir.'/config_override.php');
    }

    public function testzip_dir()
    {
        //execute the method and verify the if zipped file exist
        $cache_dir = rtrim($GLOBALS['sugar_config']['cache_dir'], '/\\');
        $file = $cache_dir.'/zipTest.zip';

        if (file_exists($file)) {
            unlink($file);
        }

        zip_dir($cache_dir.'/modules', $file);

        self::assertFileExists($file);

        unlink($file);
    }

    public function testzip_files_list()
    {
        //execute the method and verify the if zipped file exist
        $cache_dir = rtrim($GLOBALS['sugar_config']['cache_dir'], '/\\');
        $file = $cache_dir.'/ziplistTest.zip';
        $files_list = array('config.php', 'config_override.php');

        if (file_exists($file)) {
            unlink($file);
        }

        $result = zip_files_list($file, $files_list);

        self::assertTrue($result);
        self::assertFileExists($file);

        unlink($file);
    }
}
