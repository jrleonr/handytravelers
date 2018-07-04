<?php

use Handytravelers\Components\Places\Models\Place;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlacesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert(DB::raw("
            INSERT INTO `places` (`id`, `place_id`, `name`, `slug`, `description`, `lat`, `lng`, `type`, `parent_id`, `lft`, `rgt`, `depth`, `created_at`, `updated_at`)
            VALUES
            (1,'','Africa','africa',NULL,'','','continent',NULL,1,186,0,'2014-10-08 14:07:36','2017-02-02 10:11:01'),
            (2,'','Asia','asia',NULL,'','','continent',NULL,187,728,0,'2014-10-08 14:07:36','2017-02-02 10:11:01'),
            (3,'','Europe','europe',NULL,'','','continent',NULL,729,1504,0,'2014-10-08 14:07:36','2017-02-02 10:11:01'),
            (4,'','North America','north-america',NULL,'','','continent',NULL,1505,2208,0,'2014-10-08 14:07:36','2017-02-02 10:11:01'),
            (5,'','South America','south-america',NULL,'','','continent',NULL,2209,3186,0,'2014-10-08 14:07:36','2017-02-02 10:11:01'),
            (6,'','Oceania','oceania',NULL,'','','continent',NULL,3187,3274,0,'2014-10-08 14:07:36','2017-02-02 10:11:01'),
            (7,'','Gabon','gabon',NULL,'','','country',1,2,3,1,'2014-10-08 14:07:40','2014-10-08 14:07:40'),
            (8,'','Namibia','namibia',NULL,'','','country',1,4,5,1,'2014-10-08 14:07:40','2014-10-08 14:07:40'),
            (9,'','Niger','niger',NULL,'','','country',1,6,7,1,'2014-10-08 14:07:40','2014-10-08 14:07:40'),
            (10,'','Cape Verde','cape-verde',NULL,'','','country',1,8,9,1,'2014-10-08 14:07:40','2014-10-08 14:07:40'),
            (11,'','Gambia','gambia',NULL,'','','country',1,10,11,1,'2014-10-08 14:07:40','2014-10-08 14:07:40'),
            (12,'','Guinea','guinea',NULL,'','','country',1,12,13,1,'2014-10-08 14:07:40','2014-10-08 14:07:40'),
            (13,'','Equatorial Guinea','equatorial-guinea',NULL,'','','country',1,14,15,1,'2014-10-08 14:07:40','2014-10-08 14:07:40'),
            (14,'','Cameroon','cameroon',NULL,'','','country',1,16,21,1,'2014-10-08 14:07:40','2016-11-22 05:19:49'),
            (15,'','Côte d\'Ivoire','cote-divoire',NULL,'','','country',1,22,23,1,'2014-10-08 14:07:40','2016-11-22 05:19:49'),
            (16,'','Zimbabwe','zimbabwe',NULL,'','','country',1,24,25,1,'2014-10-08 14:07:40','2016-11-22 05:19:49'),
            (17,'','Central African Republic','central-african-republic',NULL,'','','country',1,26,27,1,'2014-10-08 14:07:40','2016-11-22 05:19:49'),
            (18,'','Congo','congo',NULL,'','','country',1,28,29,1,'2014-10-08 14:07:40','2016-11-22 05:19:49'),
            (19,'','Reunion','reunion',NULL,'','','country',1,30,31,1,'2014-10-08 14:07:40','2016-11-22 05:19:49'),
            (20,'','Rwanda','rwanda',NULL,'','','country',1,32,33,1,'2014-10-08 14:07:40','2016-11-22 05:19:49'),
            (21,'','Kenya','kenya',NULL,'','','country',1,34,43,1,'2014-10-08 14:07:40','2016-11-22 05:19:49'),
            (22,'','Mozambique','mozambique',NULL,'','','country',1,44,45,1,'2014-10-08 14:07:40','2016-11-22 05:19:49'),
            (23,'','Comoros','comoros',NULL,'','','country',1,46,47,1,'2014-10-08 14:07:40','2016-11-22 05:19:49'),
            (24,'','Liberia','liberia',NULL,'','','country',1,48,49,1,'2014-10-08 14:07:40','2016-11-22 05:19:49'),
            (25,'','Lesotho','lesotho',NULL,'','','country',1,50,51,1,'2014-10-08 14:07:40','2016-11-22 05:19:49'),
            (26,'','Libya','libya',NULL,'','','country',1,52,53,1,'2014-10-08 14:07:40','2016-11-22 05:19:49'),
            (27,'','Morocco','morocco',NULL,'','','country',1,54,81,1,'2014-10-08 14:07:40','2017-02-02 10:11:01'),
            (28,'','Madagascar','madagascar',NULL,'','','country',1,82,83,1,'2014-10-08 14:07:40','2017-02-02 10:11:01'),
            (29,'','Ethiopia','ethiopia',NULL,'','','country',1,84,85,1,'2014-10-08 14:07:40','2017-02-02 10:11:01'),
            (30,'','Mali','mali',NULL,'','','country',1,86,87,1,'2014-10-08 14:07:40','2017-02-02 10:11:01'),
            (31,'','Eritrea','eritrea',NULL,'','','country',1,88,89,1,'2014-10-08 14:07:40','2017-02-02 10:11:01'),
            (32,'','Western Sahara','western-sahara',NULL,'','','country',1,90,91,1,'2014-10-08 14:07:40','2017-02-02 10:11:01'),
            (33,'','Egypt','egypt',NULL,'','','country',1,92,109,1,'2014-10-08 14:07:40','2017-02-02 10:11:01'),
            (34,'','Algeria','algeria',NULL,'','','country',1,110,115,1,'2014-10-08 14:07:40','2017-02-02 10:11:01'),
            (35,'','Ghana','ghana',NULL,'','','country',1,116,125,1,'2014-10-08 14:07:40','2017-02-02 10:11:01'),
            (36,'','Mauritania','mauritania',NULL,'','','country',1,126,127,1,'2014-10-08 14:07:40','2017-02-02 10:11:01'),
            (37,'','Mauritius','mauritius',NULL,'','','country',1,128,129,1,'2014-10-08 14:07:40','2017-02-02 10:11:01'),
            (38,'','Djibouti','djibouti',NULL,'','','country',1,130,131,1,'2014-10-08 14:07:40','2017-02-02 10:11:01'),
            (39,'','Seychelles','seychelles',NULL,'','','country',1,132,133,1,'2014-10-08 14:07:40','2017-02-02 10:11:01'),
            (40,'','Botswana','botswana',NULL,'','','country',1,134,135,1,'2014-10-08 14:07:40','2017-02-02 10:11:01'),
            (41,'','Senegal','senegal',NULL,'','','country',1,136,137,1,'2014-10-08 14:07:41','2017-02-02 10:11:01'),
            (42,'','Mayotte','mayotte',NULL,'','','country',1,138,139,1,'2014-10-08 14:07:41','2017-02-02 10:11:01'),
            (43,'','Malawi','malawi',NULL,'','','country',1,140,141,1,'2014-10-08 14:07:41','2017-02-02 10:11:01'),
            (44,'','Swaziland','swaziland',NULL,'','','country',1,142,143,1,'2014-10-08 14:07:41','2017-02-02 10:11:01'),
            (45,'','Burkina Faso','burkina-faso',NULL,'','','country',1,144,145,1,'2014-10-08 14:07:41','2017-02-02 10:11:01'),
            (46,'','Chad','chad',NULL,'','','country',1,146,147,1,'2014-10-08 14:07:41','2017-02-02 10:11:01'),
            (47,'','Uganda','uganda',NULL,'','','country',1,148,149,1,'2014-10-08 14:07:41','2017-02-02 10:11:01'),
            (48,'','Togo','togo',NULL,'','','country',1,150,151,1,'2014-10-08 14:07:41','2017-02-02 10:11:01'),
            (49,'','Tanzania','tanzania',NULL,'','','country',1,152,153,1,'2014-10-08 14:07:41','2017-02-02 10:11:01'),
            (50,'','Nigeria','nigeria',NULL,'','','country',1,154,155,1,'2014-10-08 14:07:41','2017-02-02 10:11:01'),
            (51,'','Burundi','burundi',NULL,'','','country',1,156,157,1,'2014-10-08 14:07:41','2017-02-02 10:11:01'),
            (52,'','Guinea-Bissau','guinea-bissau',NULL,'','','country',1,158,159,1,'2014-10-08 14:07:41','2017-02-02 10:11:01'),
            (53,'','Angola','angola',NULL,'','','country',1,160,161,1,'2014-10-08 14:07:41','2017-02-02 10:11:01'),
            (54,'','Sudan','sudan',NULL,'','','country',1,162,163,1,'2014-10-08 14:07:41','2017-02-02 10:11:01'),
            (55,'','Benin','benin',NULL,'','','country',1,164,165,1,'2014-10-08 14:07:41','2017-02-02 10:11:01'),
            (56,'','Saint Helena','saint-helena-ascension-and-tristan-da-cunha',NULL,'','','country',1,166,167,1,'2014-10-08 14:07:41','2017-02-02 10:11:01'),
            (57,'','Sierra Leone','sierra-leone',NULL,'','','country',1,168,169,1,'2014-10-08 14:07:41','2017-02-02 10:11:01'),
            (58,'','Zambia','zambia',NULL,'','','country',1,170,171,1,'2014-10-08 14:07:41','2017-02-02 10:11:01'),
            (59,'','Somalia','somalia',NULL,'','','country',1,172,173,1,'2014-10-08 14:07:41','2017-02-02 10:11:01'),
            (60,'','South Sudan','south-sudan',NULL,'','','country',1,174,175,1,'2014-10-08 14:07:41','2017-02-02 10:11:01'),
            (61,'','São Tomé and Príncipe','sao-tome-and-principe',NULL,'','','country',1,176,177,1,'2014-10-08 14:07:41','2017-02-02 10:11:01'),
            (62,'','South Africa','south-africa',NULL,'','','country',1,178,179,1,'2014-10-08 14:07:41','2017-02-02 10:11:01'),
            (63,'','Tunisia','tunisia',NULL,'','','country',1,180,185,1,'2014-10-08 14:07:41','2017-02-02 10:11:01'),
            (64,'','Israel','israel',NULL,'','','country',2,188,193,1,'2014-10-08 14:07:41','2017-02-02 10:11:01'),
            (65,'','Korea','korea',NULL,'','','country',2,194,195,1,'2014-10-08 14:07:41','2017-02-02 10:11:01'),
            (66,'','Iran','iran',NULL,'','','country',2,196,197,1,'2014-10-08 14:07:41','2017-02-02 10:11:01'),
            (67,'','Kazakhstan','kazakhstan',NULL,'','','country',2,198,199,1,'2014-10-08 14:07:41','2017-02-02 10:11:01'),
            (68,'','Japan','japan',NULL,'','','country',2,200,229,1,'2014-10-08 14:07:41','2017-02-02 10:11:01'),
            (69,'','India','india',NULL,'','','country',2,230,341,1,'2014-10-08 14:07:41','2017-02-02 10:11:01'),
            (70,'','British Indian Ocean Territory','british-indian-ocean-territory-chagos-archipelago',NULL,'','','country',2,342,343,1,'2014-10-08 14:07:41','2017-02-02 10:11:01'),
            (71,'','Kyrgyzstan','kyrgyzstan',NULL,'','','country',2,344,345,1,'2014-10-08 14:07:41','2017-02-02 10:11:01'),
            (72,'','Cambodia','cambodia',NULL,'','','country',2,346,349,1,'2014-10-08 14:07:41','2017-02-02 10:11:01'),
            (73,'','Jordan','jordan',NULL,'','','country',2,350,355,1,'2014-10-08 14:07:41','2017-02-02 10:11:01'),
            (74,'','Kuwait','kuwait',NULL,'','','country',2,356,357,1,'2014-10-08 14:07:41','2017-02-02 10:11:01'),
            (75,'','South Korea','south-korea',NULL,'','','country',2,358,361,1,'2014-10-08 14:07:41','2017-02-02 10:11:01'),
            (76,'','Iraq','iraq',NULL,'','','country',2,362,363,1,'2014-10-08 14:07:41','2017-02-02 10:11:01'),
            (77,'','Laos','laos',NULL,'','','country',2,364,365,1,'2014-10-08 14:07:41','2017-02-02 10:11:01'),
            (78,'','Lebanon','lebanon',NULL,'','','country',2,366,367,1,'2014-10-08 14:07:41','2017-02-02 10:11:01'),
            (79,'','Saudi Arabia','saudi-arabia',NULL,'','','country',2,368,373,1,'2014-10-08 14:07:41','2017-02-02 10:11:01'),
            (80,'','Singapore','singapore',NULL,'','','country',2,374,377,1,'2014-10-08 14:07:41','2017-02-02 10:11:01'),
            (81,'','Qatar','qatar',NULL,'','','country',2,378,379,1,'2014-10-08 14:07:41','2017-02-02 10:11:01'),
            (82,'','Syria','syrian-arab-republic',NULL,'','','country',2,380,381,1,'2014-10-08 14:07:41','2017-02-02 10:11:01'),
            (83,'','Tajikistan','tajikistan',NULL,'','','country',2,382,383,1,'2014-10-08 14:07:42','2017-02-02 10:11:01'),
            (84,'','Timor-Leste','timor-leste',NULL,'','','country',2,384,385,1,'2014-10-08 14:07:42','2017-02-02 10:11:01'),
            (85,'','Turkmenistan','turkmenistan',NULL,'','','country',2,386,387,1,'2014-10-08 14:07:42','2017-02-02 10:11:01'),
            (86,'','Taiwan','taiwan',NULL,'','','country',2,388,395,1,'2014-10-08 14:07:42','2017-02-02 10:11:01'),
            (87,'','Uzbekistan','uzbekistan',NULL,'','','country',2,396,397,1,'2014-10-08 14:07:42','2017-02-02 10:11:01'),
            (88,'','Vietnam','vietnam',NULL,'','','country',2,398,467,1,'2014-10-08 14:07:42','2017-02-02 10:11:01'),
            (89,'','Palestine','palestine',NULL,'','','country',2,468,469,1,'2014-10-08 14:07:42','2017-02-02 10:11:01'),
            (90,'','Pakistan','pakistan',NULL,'','','country',2,470,475,1,'2014-10-08 14:07:42','2017-02-02 10:11:01'),
            (91,'','Sri Lanka','sri-lanka',NULL,'','','country',2,476,489,1,'2014-10-08 14:07:42','2017-02-02 10:11:01'),
            (92,'','Myanmar (Burma)','myanmar',NULL,'','','country',2,490,491,1,'2014-10-08 14:07:42','2017-02-02 10:11:01'),
            (93,'','Mongolia','mongolia',NULL,'','','country',2,492,497,1,'2014-10-08 14:07:42','2017-02-02 10:11:01'),
            (94,'','Macao','macao',NULL,'','','country',2,498,499,1,'2014-10-08 14:07:42','2017-02-02 10:11:01'),
            (95,'','Maldives','maldives',NULL,'','','country',2,500,501,1,'2014-10-08 14:07:42','2017-02-02 10:11:01'),
            (96,'','Malaysia','malaysia',NULL,'','','country',2,502,537,1,'2014-10-08 14:07:42','2017-02-02 10:11:01'),
            (97,'','Turkey','turkey',NULL,'','','country',2,538,549,1,'2014-10-08 14:07:42','2017-02-02 10:11:01'),
            (98,'','Nepal','nepal',NULL,'','','country',2,550,561,1,'2014-10-08 14:07:42','2017-02-02 10:11:01'),
            (99,'','Oman','oman',NULL,'','','country',2,562,563,1,'2014-10-08 14:07:42','2017-02-02 10:11:01'),
            (100,'','Philippines','philippines',NULL,'','','country',2,564,577,1,'2014-10-08 14:07:42','2017-02-02 10:11:01'),
            (101,'','Yemen','yemen',NULL,'','','country',2,578,579,1,'2014-10-08 14:07:42','2017-02-02 10:11:01'),
            (102,'','Christmas Island','christmas-island',NULL,'','','country',2,580,581,1,'2014-10-08 14:07:42','2017-02-02 10:11:01'),
            (103,'','Bangladesh','bangladesh',NULL,'','','country',2,582,583,1,'2014-10-08 14:07:42','2017-02-02 10:11:01'),
            (104,'','Bahrain','bahrain',NULL,'','','country',2,584,585,1,'2014-10-08 14:07:42','2017-02-02 10:11:01'),
            (105,'','Brunei','brunei-darussalam',NULL,'','','country',2,586,587,1,'2014-10-08 14:07:42','2017-02-02 10:11:01'),
            (106,'','Thailand','thailand',NULL,'','','country',2,588,633,1,'2014-10-08 14:07:42','2017-02-02 10:11:01'),
            (107,'','Cyprus','cyprus',NULL,'','','country',2,634,635,1,'2014-10-08 14:07:42','2017-02-02 10:11:01'),
            (108,'','Georgia','georgia',NULL,'','','country',2,636,637,1,'2014-10-08 14:07:42','2017-02-02 10:11:01'),
            (109,'','Bhutan','bhutan',NULL,'','','country',2,638,639,1,'2014-10-08 14:07:42','2017-02-02 10:11:01'),
            (110,'','Cocos Islands','cocos-keeling-islands',NULL,'','','country',2,640,641,1,'2014-10-08 14:07:42','2017-02-02 10:11:01'),
            (111,'','China','china',NULL,'','','country',2,642,645,1,'2014-10-08 14:07:42','2017-02-02 10:11:01'),
            (112,'','Hong Kong','hong-kong',NULL,'','','country',2,646,647,1,'2014-10-08 14:07:42','2017-02-02 10:11:01'),
            (113,'','Afghanistan','afghanistan',NULL,'','','country',2,648,649,1,'2014-10-08 14:07:42','2017-02-02 10:11:01'),
            (114,'','Azerbaijan','azerbaijan',NULL,'','','country',2,650,651,1,'2014-10-08 14:07:42','2017-02-02 10:11:01'),
            (115,'','Indonesia','indonesia',NULL,'','','country',2,652,723,1,'2014-10-08 14:07:42','2017-02-02 10:11:01'),
            (116,'','Armenia','armenia',NULL,'','','country',2,724,725,1,'2014-10-08 14:07:42','2017-02-02 10:11:01'),
            (117,'','United Arab Emirates','united-arab-emirates',NULL,'','','country',2,726,727,1,'2014-10-08 14:07:42','2017-02-02 10:11:01'),
            (118,'','Switzerland','switzerland',NULL,'','','country',3,730,735,1,'2014-10-08 14:07:42','2017-02-02 10:11:01'),
            (119,'','Portugal','portugal',NULL,'','','country',3,736,755,1,'2014-10-08 14:07:42','2017-02-02 10:11:01'),
            (120,'','Poland','poland',NULL,'','','country',3,756,789,1,'2014-10-08 14:07:42','2017-02-02 10:11:01'),
            (121,'','Andorra','andorra',NULL,'','','country',3,790,795,1,'2014-10-08 14:07:42','2017-02-02 10:11:01'),
            (122,'','Norway','norway',NULL,'','','country',3,796,801,1,'2014-10-08 14:07:42','2017-02-02 10:11:01'),
            (123,'','Netherlands','netherlands',NULL,'','','country',3,802,819,1,'2014-10-08 14:07:42','2017-02-02 10:11:01'),
            (124,'','Sweden','sweden',NULL,'','','country',3,820,825,1,'2014-10-08 14:07:43','2017-02-02 10:11:01'),
            (125,'','Czech Republic','czech-republic',NULL,'','','country',3,826,855,1,'2014-10-08 14:07:43','2017-02-02 10:11:01'),
            (126,'','Germany','germany',NULL,'','','country',3,856,897,1,'2014-10-08 14:07:43','2017-02-02 10:11:01'),
            (127,'','Denmark','denmark',NULL,'','','country',3,898,907,1,'2014-10-08 14:07:43','2017-02-02 10:11:01'),
            (128,'','Malta','malta',NULL,'','','country',3,908,911,1,'2014-10-08 14:07:43','2017-02-02 10:11:01'),
            (129,'','Bosnia & Herzegovina','bosnia-and-herzegovina',NULL,'','','country',3,912,913,1,'2014-10-08 14:07:43','2017-02-02 10:11:01'),
            (130,'','Romania','romania',NULL,'','','country',3,914,923,1,'2014-10-08 14:07:43','2017-02-02 10:11:01'),
            (131,'','Serbia','serbia',NULL,'','','country',3,924,931,1,'2014-10-08 14:07:43','2017-02-02 10:11:01'),
            (132,'','Belgium','belgium',NULL,'','','country',3,932,943,1,'2014-10-08 14:07:43','2017-02-02 10:11:01'),
            (133,'','Bulgaria','bulgaria',NULL,'','','country',3,944,951,1,'2014-10-08 14:07:43','2017-02-02 10:11:01'),
            (134,'','Aland Islands','aland-islands',NULL,'','','country',3,952,953,1,'2014-10-08 14:07:43','2017-02-02 10:11:01'),
            (135,'','Austria','austria',NULL,'','','country',3,954,963,1,'2014-10-08 14:07:43','2017-02-02 10:11:01'),
            (136,'','San Marino','san-marino',NULL,'','','country',3,964,965,1,'2014-10-08 14:07:43','2017-02-02 10:11:01'),
            (137,'','Slovakia (Slovak Republic)','slovakia-slovak-republic',NULL,'','','country',3,966,967,1,'2014-10-08 14:07:43','2017-02-02 10:11:01'),
            (138,'','Svalbard and Jan Mayen','svalbard-jan-mayen-islands',NULL,'','','country',3,968,969,1,'2014-10-08 14:07:43','2017-02-02 10:11:01'),
            (139,'','Slovenia','slovenia',NULL,'','','country',3,970,975,1,'2014-10-08 14:07:43','2017-02-02 10:11:01'),
            (140,'','Ukraine','ukraine',NULL,'','','country',3,976,997,1,'2014-10-08 14:07:43','2017-02-02 10:11:01'),
            (141,'','Holy See (Vatican City State)','holy-see-vatican-city-state',NULL,'','','country',3,998,999,1,'2014-10-08 14:07:43','2017-02-02 10:11:01'),
            (142,'','Albania','albania',NULL,'','','country',3,1000,1001,1,'2014-10-08 14:07:43','2017-02-02 10:11:01'),
            (143,'','Belarus','belarus',NULL,'','','country',3,1002,1013,1,'2014-10-08 14:07:43','2017-02-02 10:11:01'),
            (144,'','Russia','russia',NULL,'','','country',3,1014,1025,1,'2014-10-08 14:07:43','2017-02-02 10:11:01'),
            (145,'','Estonia','estonia',NULL,'','','country',3,1026,1031,1,'2014-10-08 14:07:43','2017-02-02 10:11:01'),
            (146,'','Spain','spain',NULL,'','','country',3,1032,1307,1,'2014-10-08 14:07:43','2017-02-02 10:11:01'),
            (147,'','Montenegro','montenegro',NULL,'','','country',3,1308,1309,1,'2014-10-08 14:07:43','2017-02-02 10:11:01'),
            (148,'','Moldova','moldova',NULL,'','','country',3,1310,1311,1,'2014-10-08 14:07:43','2017-02-02 10:11:01'),
            (149,'','Greece','greece',NULL,'','','country',3,1312,1313,1,'2014-10-08 14:07:43','2017-02-02 10:11:01'),
            (150,'','Iceland','iceland',NULL,'','','country',3,1314,1315,1,'2014-10-08 14:07:43','2017-02-02 10:11:01'),
            (151,'','Luxembourg','luxembourg',NULL,'','','country',3,1316,1317,1,'2014-10-08 14:07:43','2017-02-02 10:11:01'),
            (152,'','Lithuania','lithuania',NULL,'','','country',3,1318,1323,1,'2014-10-08 14:07:43','2017-02-02 10:11:01'),
            (153,'','Italy','italy',NULL,'','','country',3,1324,1383,1,'2014-10-08 14:07:43','2017-02-02 10:11:01'),
            (154,'','Jersey','jersey',NULL,'','','country',3,1384,1385,1,'2014-10-08 14:07:43','2017-02-02 10:11:01'),
            (155,'','Guernsey','guernsey',NULL,'','','country',3,1386,1391,1,'2014-10-08 14:07:43','2017-02-02 10:11:01'),
            (156,'','Gibraltar','gibraltar',NULL,'','','country',3,1392,1393,1,'2014-10-08 14:07:43','2017-02-02 10:11:01'),
            (157,'','Monaco','monaco',NULL,'','','country',3,1394,1395,1,'2014-10-08 14:07:43','2017-02-02 10:11:01'),
            (158,'','Croatia','croatia',NULL,'','','country',3,1396,1397,1,'2014-10-08 14:07:43','2017-02-02 10:11:01'),
            (159,'','Ireland','ireland',NULL,'','','country',3,1398,1403,1,'2014-10-08 14:07:43','2017-02-02 10:11:01'),
            (160,'','Isle of Man','isle-of-man',NULL,'','','country',3,1404,1405,1,'2014-10-08 14:07:43','2017-02-02 10:11:01'),
            (161,'','Latvia','latvia',NULL,'','','country',3,1406,1411,1,'2014-10-08 14:07:43','2017-02-02 10:11:01'),
            (162,'','United Kingdom','united-kingdom',NULL,'','','country',3,1412,1433,1,'2014-10-08 14:07:43','2017-02-02 10:11:01'),
            (163,'','Hungary','hungary',NULL,'','','country',3,1434,1439,1,'2014-10-08 14:07:43','2017-02-02 10:11:01'),
            (164,'','Liechtenstein','liechtenstein',NULL,'','','country',3,1440,1441,1,'2014-10-08 14:07:43','2017-02-02 10:11:01'),
            (165,'','Macedonia (FYROM)','macedonia',NULL,'','','country',3,1442,1443,1,'2014-10-08 14:07:43','2017-02-02 10:11:01'),
            (166,'','France','france',NULL,'','','country',3,1444,1485,1,'2014-10-08 14:07:44','2017-02-02 10:11:01'),
            (167,'','Finland','finland',NULL,'','','country',3,1486,1501,1,'2014-10-08 14:07:44','2017-02-02 10:11:01'),
            (168,'','Faroe Islands','faroe-islands',NULL,'','','country',3,1502,1503,1,'2014-10-08 14:07:44','2017-02-02 10:11:01'),
            (169,'','Greenland','greenland',NULL,'','','country',4,1506,1507,1,'2014-10-08 14:07:44','2017-02-02 10:11:01'),
            (170,'','Bonaire, Sint Eustatius and Saba','bonaire-sint-eustatius-and-saba',NULL,'','','country',4,1508,1509,1,'2014-10-08 14:07:44','2017-02-02 10:11:01'),
            (171,'','Haiti','haiti',NULL,'','','country',4,1510,1515,1,'2014-10-08 14:07:44','2017-02-02 10:11:01'),
            (172,'','Cayman Islands','cayman-islands',NULL,'','','country',4,1516,1517,1,'2014-10-08 14:07:44','2017-02-02 10:11:01'),
            (173,'','Grenada','grenada',NULL,'','','country',4,1518,1519,1,'2014-10-08 14:07:44','2017-02-02 10:11:01'),
            (174,'','Belize','belize',NULL,'','','country',4,1520,1521,1,'2014-10-08 14:07:44','2017-02-02 10:11:01'),
            (175,'','Bermuda','bermuda',NULL,'','','country',4,1522,1523,1,'2014-10-08 14:07:44','2017-02-02 10:11:01'),
            (176,'','Saint Barthélemy','saint-barthelemy',NULL,'','','country',4,1524,1525,1,'2014-10-08 14:07:44','2017-02-02 10:11:01'),
            (177,'','Anguilla','anguilla',NULL,'','','country',4,1526,1527,1,'2014-10-08 14:07:44','2017-02-02 10:11:01'),
            (178,'','United States Virgin Islands','united-states-virgin-islands',NULL,'','','country',4,1528,1529,1,'2014-10-08 14:07:44','2017-02-02 10:11:01'),
            (179,'','British Virgin Islands','british-virgin-islands',NULL,'','','country',4,1530,1531,1,'2014-10-08 14:07:44','2017-02-02 10:11:01'),
            (180,'','Saint Vincent and the Grenadines','saint-vincent-and-the-grenadines',NULL,'','','country',4,1532,1533,1,'2014-10-08 14:07:44','2017-02-02 10:11:01'),
            (181,'','United States','united-states',NULL,'','','country',4,1534,1657,1,'2014-10-08 14:07:44','2017-02-02 10:11:01'),
            (182,'','Honduras','honduras',NULL,'','','country',4,1658,1685,1,'2014-10-08 14:07:44','2017-02-02 10:11:01'),
            (183,'','Trinidad & Tobago','trinidad-and-tobago',NULL,'','','country',4,1686,1687,1,'2014-10-08 14:07:44','2017-02-02 10:11:01'),
            (184,'','Aruba','aruba',NULL,'','','country',4,1688,1691,1,'2014-10-08 14:07:44','2017-02-02 10:11:01'),
            (185,'','Jamaica','jamaica',NULL,'','','country',4,1692,1693,1,'2014-10-08 14:07:44','2017-02-02 10:11:01'),
            (186,'','Bahamas','bahamas',NULL,'','','country',4,1694,1695,1,'2014-10-08 14:07:44','2017-02-02 10:11:01'),
            (187,'','Barbados','barbados',NULL,'','','country',4,1696,1697,1,'2014-10-08 14:07:44','2017-02-02 10:11:01'),
            (188,'','Guatemala','guatemala',NULL,'','','country',4,1698,1737,1,'2014-10-08 14:07:44','2017-02-02 10:11:01'),
            (189,'','Turks and Caicos Islands','turks-and-caicos-islands',NULL,'','','country',4,1738,1739,1,'2014-10-08 14:07:44','2017-02-02 10:11:01'),
            (190,'','Guadeloupe','guadeloupe',NULL,'','','country',4,1740,1741,1,'2014-10-08 14:07:44','2017-02-02 10:11:01'),
            (191,'','El Salvador','el-salvador',NULL,'','','country',4,1742,1781,1,'2014-10-08 14:07:44','2017-02-02 10:11:01'),
            (192,'','Antigua and Barbuda','antigua-and-barbuda',NULL,'','','country',4,1782,1783,1,'2014-10-08 14:07:44','2017-02-02 10:11:01'),
            (193,'','Canada','canada',NULL,'','','country',4,1784,1803,1,'2014-10-08 14:07:44','2017-02-02 10:11:01'),
            (194,'','Montserrat','montserrat',NULL,'','','country',4,1804,1805,1,'2014-10-08 14:07:44','2017-02-02 10:11:01'),
            (195,'','Cuba','cuba',NULL,'','','country',4,1806,1815,1,'2014-10-08 14:07:44','2017-02-02 10:11:01'),
            (196,'','Mexico','mexico',NULL,'','','country',4,1816,2093,1,'2014-10-08 14:07:44','2017-02-02 10:11:01'),
            (197,'','Saint Martin','saint-martin',NULL,'','','country',4,2094,2095,1,'2014-10-08 14:07:44','2017-02-02 10:11:01'),
            (198,'','Panama','panama',NULL,'','','country',4,2096,2101,1,'2014-10-08 14:07:44','2017-02-02 10:11:01'),
            (199,'','Curaçao','curacao',NULL,'','','country',4,2102,2103,1,'2014-10-08 14:07:44','2017-02-02 10:11:01'),
            (200,'','Costa Rica','costa-rica',NULL,'','','country',4,2104,2147,1,'2014-10-08 14:07:44','2017-02-02 10:11:01'),
            (201,'','Nicaragua','nicaragua',NULL,'','','country',4,2148,2169,1,'2014-10-08 14:07:44','2017-02-02 10:11:01'),
            (202,'','Dominica','dominica',NULL,'','','country',4,2170,2171,1,'2014-10-08 14:07:44','2017-02-02 10:11:01'),
            (203,'','Saint Pierre and Miquelon','saint-pierre-and-miquelon',NULL,'','','country',4,2172,2173,1,'2014-10-08 14:07:44','2017-02-02 10:11:01'),
            (204,'','Sint Maarten (Dutch part)','sint-maarten-dutch-part',NULL,'','','country',4,2174,2175,1,'2014-10-08 14:07:44','2017-02-02 10:11:01'),
            (205,'','Dominican Republic','dominican-republic',NULL,'','','country',4,2176,2189,1,'2014-10-08 14:07:44','2017-02-02 10:11:01'),
            (206,'','Puerto Rico','puerto-rico',NULL,'','','country',4,2190,2201,1,'2014-10-08 14:07:44','2017-02-02 10:11:01'),
            (207,'','Saint Kitts and Nevis','saint-kitts-and-nevis',NULL,'','','country',4,2202,2203,1,'2014-10-08 14:07:44','2017-02-02 10:11:01'),
            (208,'','Saint Lucia','saint-lucia',NULL,'','','country',4,2204,2205,1,'2014-10-08 14:07:44','2017-02-02 10:11:01'),
            (209,'','Martinique','martinique',NULL,'','','country',4,2206,2207,1,'2014-10-08 14:07:45','2017-02-02 10:11:01'),
            (210,'','New Zealand','new-zealand',NULL,'','','country',6,3188,3197,1,'2014-10-08 14:07:45','2017-02-02 10:11:01'),
            (211,'','Tuvalu','tuvalu',NULL,'','','country',6,3198,3199,1,'2014-10-08 14:07:45','2017-02-02 10:11:01'),
            (212,'','Vanuatu','vanuatu',NULL,'','','country',6,3200,3201,1,'2014-10-08 14:07:45','2017-02-02 10:11:01'),
            (213,'','Norfolk Island','norfolk-island',NULL,'','','country',6,3202,3203,1,'2014-10-08 14:07:45','2017-02-02 10:11:01'),
            (214,'','Australia','australia',NULL,'','','country',6,3204,3231,1,'2014-10-08 14:07:45','2017-02-02 10:11:01'),
            (215,'','American Samoa','american-samoa',NULL,'','','country',6,3232,3233,1,'2014-10-08 14:07:45','2017-02-02 10:11:01'),
            (216,'','New Caledonia','new-caledonia',NULL,'','','country',6,3234,3235,1,'2014-10-08 14:07:45','2017-02-02 10:11:01'),
            (217,'','Northern Mariana Islands','northern-mariana-islands',NULL,'','','country',6,3236,3237,1,'2014-10-08 14:07:45','2017-02-02 10:11:01'),
            (218,'','Papua New Guinea','papua-new-guinea',NULL,'','','country',6,3238,3239,1,'2014-10-08 14:07:45','2017-02-02 10:11:01'),
            (219,'','United States Minor Outlying Islands','united-states-minor-outlying-islands',NULL,'','','country',6,3240,3241,1,'2014-10-08 14:07:45','2017-02-02 10:11:01'),
            (220,'','Samoa','samoa',NULL,'','','country',6,3242,3243,1,'2014-10-08 14:07:45','2017-02-02 10:11:01'),
            (221,'','Marshall Islands','marshall-islands',NULL,'','','country',6,3244,3245,1,'2014-10-08 14:07:45','2017-02-02 10:11:01'),
            (222,'','Wallis and Futuna','wallis-and-futuna',NULL,'','','country',6,3246,3247,1,'2014-10-08 14:07:45','2017-02-02 10:11:01'),
            (223,'','Palau','palau',NULL,'','','country',6,3248,3249,1,'2014-10-08 14:07:45','2017-02-02 10:11:01'),
            (224,'','Tonga','tonga',NULL,'','','country',6,3250,3251,1,'2014-10-08 14:07:45','2017-02-02 10:11:01'),
            (225,'','Cook Islands','cook-islands',NULL,'','','country',6,3252,3253,1,'2014-10-08 14:07:45','2017-02-02 10:11:01'),
            (226,'','Pitcairn Islands','pitcairn-islands',NULL,'','','country',6,3254,3255,1,'2014-10-08 14:07:45','2017-02-02 10:11:01'),
            (227,'','French Polynesia','french-polynesia',NULL,'','','country',6,3256,3257,1,'2014-10-08 14:07:45','2017-02-02 10:11:01'),
            (228,'','Micronesia','micronesia',NULL,'','','country',6,3258,3259,1,'2014-10-08 14:07:45','2017-02-02 10:11:01'),
            (229,'','Solomon Islands','solomon-islands',NULL,'','','country',6,3260,3261,1,'2014-10-08 14:07:45','2017-02-02 10:11:01'),
            (230,'','Niue','niue',NULL,'','','country',6,3262,3263,1,'2014-10-08 14:07:45','2017-02-02 10:11:01'),
            (231,'','Kiribati','kiribati',NULL,'','','country',6,3264,3265,1,'2014-10-08 14:07:45','2017-02-02 10:11:01'),
            (232,'','Guam','guam',NULL,'','','country',6,3266,3267,1,'2014-10-08 14:07:45','2017-02-02 10:11:01'),
            (233,'','Nauru','nauru',NULL,'','','country',6,3268,3269,1,'2014-10-08 14:07:45','2017-02-02 10:11:01'),
            (234,'','Fiji','fiji',NULL,'','','country',6,3270,3271,1,'2014-10-08 14:07:45','2017-02-02 10:11:01'),
            (235,'','Tokelau','tokelau',NULL,'','','country',6,3272,3273,1,'2014-10-08 14:07:45','2017-02-02 10:11:01'),
            (236,'','Bolivia','bolivia',NULL,'','','country',5,2210,2239,1,'2014-10-08 14:07:45','2017-02-02 10:11:01'),
            (237,'','Chile','chile',NULL,'','','country',5,2240,2377,1,'2014-10-08 14:07:45','2017-02-02 10:11:01'),
            (238,'','Brazil','brazil',NULL,'','','country',5,2378,2431,1,'2014-10-08 14:07:45','2017-02-02 10:11:01'),
            (239,'','Paraguay','paraguay',NULL,'','','country',5,2432,2459,1,'2014-10-08 14:07:45','2017-02-02 10:11:01'),
            (240,'','Ecuador','ecuador',NULL,'','','country',5,2460,2549,1,'2014-10-08 14:07:45','2017-02-02 10:11:01'),
            (241,'','Suriname','suriname',NULL,'','','country',5,2550,2551,1,'2014-10-08 14:07:45','2017-02-02 10:11:01'),
            (242,'','Venezuela','venezuela',NULL,'','','country',5,2552,2615,1,'2014-10-08 14:07:45','2017-02-02 10:11:01'),
            (243,'','Guyana','guyana',NULL,'','','country',5,2616,2617,1,'2014-10-08 14:07:45','2017-02-02 10:11:01'),
            (244,'','Falkland Islands (Islas Malvinas)','falkland-islands-malvinas',NULL,'','','country',5,2618,2619,1,'2014-10-08 14:07:45','2017-02-02 10:11:01'),
            (245,'','Uruguay','uruguay',NULL,'','','country',5,2620,2651,1,'2014-10-08 14:07:45','2017-02-02 10:11:01'),
            (246,'','Peru','peru',NULL,'','','country',5,2652,2767,1,'2014-10-08 14:07:45','2017-02-02 10:11:01'),
            (247,'','French Guiana','french-guiana',NULL,'','','country',5,2768,2769,1,'2014-10-08 14:07:45','2017-02-02 10:11:01'),
            (248,'','Colombia','colombia',NULL,'','','country',5,2770,2935,1,'2014-10-08 14:07:45','2017-02-02 10:11:01'),
            (249,'','Argentina','argentina',NULL,'','','country',5,2936,3185,1,'2014-10-08 14:07:45','2017-02-02 10:11:01');
            "));
    }
}