<?php

namespace Handler;

class Crc32 {
  private static $crc32Table = array(
    0          , 79764919   , 159529838  , 222504665  , 319059676  , 398814059  , 445009330  , 507990021  ,
    638119352  , 583659535  , 797628118  , 726387553  , 890018660  , 835552979  , 1015980042 , 944750013  ,
    1276238704 , 1221641927 , 1167319070 , 1095957929 , 1595256236 , 1540665371 , 1452775106 , 1381403509 ,
    1780037320 , 1859660671 , 1671105958 , 1733955601 , 2031960084 , 2111593891 , 1889500026 , 1952343757 ,
    -1742489888, -1662866601, -1851683442, -1788833735, -1960329156, -1880695413, -2103051438, -2040207643,
    -1104454824, -1159051537, -1213636554, -1284997759, -1389417084, -1444007885, -1532160278, -1603531939,
    -734892656 , -789352409 , -575645954 , -646886583 , -952755380 , -1007220997, -827056094 , -898286187 ,
    -231047128 , -151282273 , -71779514  , -8804623   , -515967244 , -436212925 , -390279782 , -327299027 ,
    881225847  , 809987520  , 1023691545 , 969234094  , 662832811  , 591600412  , 771767749  , 717299826  ,
    311336399  , 374308984  , 453813921  , 533576470  , 25881363   , 88864420   , 134795389  , 214552010  ,
    2023205639 , 2086057648 , 1897238633 , 1976864222 , 1804852699 , 1867694188 , 1645340341 , 1724971778 ,
    1587496639 , 1516133128 , 1461550545 , 1406951526 , 1302016099 , 1230646740 , 1142491917 , 1087903418 ,
    -1398421865, -1469785312, -1524105735, -1578704818, -1079922613, -1151291908, -1239184603, -1293773166,
    -1968362705, -1905510760, -2094067647, -2014441994, -1716953613, -1654112188, -1876203875, -1796572374,
    -525066777 , -462094256 , -382327159 , -302564546 , -206542021 , -143559028 , -97365931  , -17609246  ,
    -960696225 , -1031934488, -817968335 , -872425850 , -709327229 , -780559564 , -600130067 , -654598054 ,
    1762451694 , 1842216281 , 1619975040 , 1682949687 , 2047383090 , 2127137669 , 1938468188 , 2001449195 ,
    1325665622 , 1271206113 , 1183200824 , 1111960463 , 1543535498 , 1489069629 , 1434599652 , 1363369299 ,
    622672798  , 568075817  , 748617968  , 677256519  , 907627842  , 853037301  , 1067152940 , 995781531  ,
    51762726   , 131386257  , 177728840  , 240578815  , 269590778  , 349224269  , 429104020  , 491947555  ,
    -248556018 , -168932423 , -122852000 , -60002089  , -500490030 , -420856475 , -341238852 , -278395381 ,
    -685261898 , -739858943 , -559578920 , -630940305 , -1004286614, -1058877219, -845023740 , -916395085 ,
    -1119974018, -1174433591, -1262701040, -1333941337, -1371866206, -1426332139, -1481064244, -1552294533,
    -1690935098, -1611170447, -1833673816, -1770699233, -2009983462, -1930228819, -2119160460, -2056179517,
    1569362073 , 1498123566 , 1409854455 , 1355396672 , 1317987909 , 1246755826 , 1192025387 , 1137557660 ,
    2072149281 , 2135122070 , 1912620623 , 1992383480 , 1753615357 , 1816598090 , 1627664531 , 1707420964 ,
    295390185  , 358241886  , 404320391  , 483945776  , 43990325   , 106832002  , 186451547  , 266083308  ,
    932423249  , 861060070  , 1041341759 , 986742920  , 613929101  , 542559546  , 756411363  , 701822548  ,
    -978770311 , -1050133554, -869589737 , -924188512 , -693284699 , -764654318 , -550540341 , -605129092 ,
    -475935807 , -413084042 , -366743377 , -287118056 , -257573603 , -194731862 , -114850189 , -35218492  ,
    -1984365303, -1921392450, -2143631769, -2063868976, -1698919467, -1635936670, -1824608069, -1744851700,
    -1347415887, -1418654458, -1506661409, -1561119128, -1129027987, -1200260134, -1254728445, -1309196108
  );

  public static function getCrc32($data) {
    $Length = strlen($data);
    $nReg = -1;

    for ($n = 0; $n < $Length; $n++) {
      $nReg ^= ord($data[$n]);
      for ($i = 0; $i < 4; $i++) {
        $nTemp = self::$crc32Table[($nReg >> 24) & 0xff];
        $nReg <<= 8;
        $nReg ^= $nTemp;
      }
    }
    return $nReg & 0xFFFFFFFF;
  }
}