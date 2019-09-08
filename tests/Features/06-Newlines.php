<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class Features_Newlines extends TestCase
{
   public function testNewlines()
   {
      $firephp = new FirePHP_TestWrapper();

      $firephp->log('Hello\nWorld');

      $this->assertEquals(
         $firephp->_getHeader(4),
         '89|[{"Type":"LOG","File":"...\/tests\/Features\/06-Newlines.php","Line":' . (__LINE__-4) . '},"Hello\\\\nWorld"]|'
      );

      $firephp->log(array('Hello\nWorld'));

      $this->assertEquals(
         $firephp->_getHeader(6),
         '91|[{"Type":"LOG","File":"...\/tests\/Features\/06-Newlines.php","Line":' . (__LINE__-4) . '},["Hello\\\\nWorld"]]|'
      );

      $firephp->table('Table cell with newline', array(
         array('Header\nSubheading'),
         array('Hello\nWorld'),
      ));

      $this->assertEquals(
         $firephp->_getHeader(7),
         '153|[{"Type":"TABLE","Label":"Table cell with newline","File":"...\/tests\/Features\/06-Newlines.php","Line":' . (__LINE__-6) . '},[["Header\\\\nSubheading"],["Hello\\\\nWorld"]]]|'
      );
   }
}
