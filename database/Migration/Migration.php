<?php
/**
 * User: anwar@honestmining.com
 * Date: 2019-12-07
 * Time: 18:00
 */

require '../../autoload.php';

use lib\Mysql\FlipMysqlConnection as Mysql;

/**
 * Class Migration
 *
 * @package database\Migration
 */
class Migration
{
    /**
     * @var $mysql Mysql
     */
    protected $mysql;

    /**
     * Migration constructor.
     *
     * @param Mysql $mysql
     */
    public function __construct(Mysql $mysql)
    {
        $this->mysql = $mysql;
    }

    /**
     * Run Migration
     */
    public function run()
    {
        $this->database();
        echo 'created database successfully'. PHP_EOL;
        $this->tableDisbursement();
        echo 'created table successfully' . PHP_EOL;
    }

    private function database()
    {
        $databaseName = getenv('MYSQL_DATABASE');
        $query = "create database $databaseName";
        $this->mysql->exec($query, [
            'database'      => null
        ]);
    }

    private function tableDisbursement()
    {
        $query = "
            CREATE TABLE `transaction` (
                  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
                  `transaction_code` varchar(45) DEFAULT '0',
                  `amount` int(11) DEFAULT '0',
                  `status` char(15) DEFAULT '''''',
                  `time_served` varchar(45) DEFAULT NULL,
                  `bank_code` varchar(45) DEFAULT '''''',
                  `account_number` varchar(25) DEFAULT '''''',
                  `beneficiary_name` varchar(45) DEFAULT '''''',
                  `remark` varchar(100) NOT NULL DEFAULT '''''',
                  `receipt` text,
                  `fee` int(11) DEFAULT '0',
                  `created_at` timestamp NULL DEFAULT NULL,
                  `updated_at` timestamp NULL DEFAULT NULL,
                  PRIMARY KEY (`id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
        ";
        $this->mysql->exec($query, [
            'database'  => getenv('MYSQL_DATABASE')
        ]);
    }

}

(new Migration(new Mysql()))->run();