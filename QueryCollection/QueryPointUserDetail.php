<?php
/**
 * Created by PhpStorm.
 * User: wangxionghao
 * Date: 16/6/13
 * Time: 下午2:32
 */

namespace QueryCollection;

use MiddlewareSpace\UserDetails;

require __DIR__ . '/../Bootstrap.php';

class QueryPointUserDetail extends UserDetails
{
    public $userList = array();

    public function main()
    {
        $this->getUserBirthDetail($this->getUserList());
        $this->getUserConsumeCnt();
        $this->getUserBackUpDetail();
        $userDetails = $this->getUserDetails();
        echo "ID;Year;Month;Day;Is_Lunar;AppId;ChnId;AllCnt;AbCnt;YabCnt;AddCnt;ConsumeCnt \n";
        foreach ($userDetails as $item) {
            echo sprintf("%d;%d;%d;%d;%d;%d;%d;%d;%d;%d;%d;%d \n",
                $item['id'], $item['birth_y'], $item['birth_m'], $item['birth_d'], $item['birth_is_lunar'], 
                $item['appid'], $item['chnid'], $item['all'], $item['ab'], $item['yab'], $item['add'], $item['consumeCnt']);
        }
    }

    public function getUserList()
    {
        $this->userList = array(378464
        ,378460
        ,3265510
        ,5003841
        ,3187969
        ,825675
        ,2716391
        ,825677
        ,2716399
        ,2986965
        ,1902209
        ,5051449
        ,5051440
        ,4281465
        ,4006455
        ,2843831
        ,4134636
        ,320598
        ,2705096
        ,4541277
        ,218137
        ,1231463
        ,2496287
        ,2750947
        ,2592646
        ,4927188
        ,4130826
        ,401246
        ,3302174
        ,2024722
        ,2656216
        ,5114347
        ,4676245
        ,5040362
        ,1643828
        ,260293
        ,1643824
        ,4718524
        ,1343331
        ,1343332
        ,1072246
        ,4823762
        ,1219824
        ,286233
        ,3690413
        ,1576769
        ,4753991
        ,762277
        ,762270
        ,88023
        ,4280335
        ,1473364
        ,1641088
        ,4705691
        ,5035874
        ,2250587
        ,3564242
        ,1341792
        ,4406126
        ,5050798
        ,1651325
        ,1881731
        ,969322
        ,671251
        ,1945170
        ,932039
        ,1650498
        ,671256
        ,1882286
        ,1650492
        ,778284
        ,176060
        ,247469
        ,49567
        ,2845068
        ,2845069
        ,3446092
        ,3568626
        ,4886265
        ,930898
        ,4121300
        ,4059676
        ,656965
        ,2034742
        ,3845630
        ,3704557
        ,656969
        ,306942
        ,250994
        ,1973349
        ,499266
        ,499267
        ,4921935
        ,168086
        ,1173892
        ,3617195
        ,1832540
        ,168088
        ,1973345
        ,4428500
        ,1958944
        ,3932549
        ,5011851
        ,4262146
        ,4996914
        ,1948033
        ,4996912
        ,62360
        ,1594477
        ,1879892
        ,2637478
        ,1594479
        ,4043855
        ,4403161
        ,840625
        ,2634927
        ,4849351
        ,2634923
        ,3348538
        ,4849356
        ,163500
        ,1979998
        ,1498217
        ,2739525
        ,2739524
        ,1304565
        ,2816227
        ,1268040
        ,2632187
        ,705094
        ,3078697
        ,549934
        ,1901724
        ,4029888
        ,4913349
        ,4913348
        ,2616103
        ,2618842
        ,4780071
        ,2178768
        ,2736230
        ,2736231
        ,1488662
        ,3437588
        ,3811499
        ,2316504
        ,2316505
        ,1863697
        ,5124308
        ,4790626
        ,3636483
        ,2471309
        ,869832
        ,1502207
        ,2325431
        ,4854272
        ,869838
        ,1060282
        ,792604
        ,1034424
        ,5065955
        ,2192397
        ,2472656
        ,380854
        ,1876555
        ,847391
        ,380857
        ,5082545
        ,380852
        ,4268932
        ,847398
        ,1149620
        ,2784969
        ,4531786
        ,495891
        ,2837556
        ,1100560
        ,1374822
        ,192883
        ,5045281
        ,4459905
        ,5078161
        ,263175
        ,1684358
        ,3406805
        ,1983660
        ,2630120
        ,564843
        ,65880
        ,65881
        ,65882
        ,4968654
        ,1479861
        ,2679882
        ,4988576
        ,710148
        ,4988573
        ,1561752
        ,1561757
        ,2326165
        ,5093632
        ,2326163
        ,2771861
        ,4204603
        ,961993
        ,3042941
        ,4116128
        ,474311
        ,4903903
        ,1119470
        ,4963358
        ,1119476
        ,2549413
        ,4963352
        ,3324078
        ,2434386
        ,3681527
        ,3945004
        ,381727
        ,381720
        ,26568
        ,107892
        ,1394462
        ,2576140
        ,2475352
        ,650938
        ,1875879
        ,1103036
        ,1685007
        ,2916661
        ,5069922
        ,617340
        ,1395333
        ,1357733
        ,150160
        ,4103041
        ,4103043
        ,92885
        ,3491571
        ,179597
        ,2390836
        ,4746801
        ,2390832
        ,2819754
        ,2631296
        ,3722220
        ,3878792
        ,2398438
        ,4878334
        ,4379957
        ,1416067
        ,4484990
        ,1416065
        ,778490
        ,2869733
        ,3826095
        ,2047462
        ,2047463
        ,3346566
        ,4330545
        ,2506156
        ,3858039
        ,1379032
        ,3144436
        ,3858031
        ,424155
        ,1014591
        ,1204587
        ,1820908
        ,773139
        ,1020518
        ,2698470
        ,5033041
        ,431620
        ,1169986
        ,5033047
        ,2191661
        ,2191665
        ,951779
        ,4344349
        ,250381
        ,105631
        ,1191592
        ,105637
        ,739717
        ,1672937
        ,2092183
        ,1432540
        ,997492
        ,1995204
        ,1995206
        ,1316992
        ,1180296
        ,2618093
        ,330906
        ,330900
        ,2581951
        ,1835869
        ,3363781
        ,4632485
        ,1813322
        ,1150792
        ,1343330
        ,1705435
        ,4392990
        ,3416977
        ,1782732
        ,5040368
        ,1914686
        ,1216175
        ,3679184
        ,727541
        ,3618598
        ,4608429
        ,4987499
        ,5032310
        ,4987496
        ,4987497
        ,3618597
        ,3817589
        ,2974376
        ,3855549
        ,408293
        ,3855545
        ,4097155
        ,4328855
        ,1697634
        ,102362
        ,3187562
        ,2670164
        ,4465355
        ,891441
        ,1419554
        ,1419553
        ,2552578
        ,1898305
        ,3466727
        ,1487356
        ,1926726
        ,1919303
        ,3890515
        ,899278
        ,4640249
        ,4875862
        ,1088660
        ,996722
        ,4547486
        ,4060981
        ,3376464
        ,2623421
        ,1159212
        ,983073
        ,4731233
        ,5046578
        ,4511953
        ,845915
        ,3326006
        ,3619883
        ,344722
        ,1128665
        ,3917761
        ,3749309
        ,136852
        ,3497118
        ,5012840
        ,531722
        ,3917769
        ,2083337
        ,2713003
        ,4015308
        ,1202320
        ,4279825
        ,1539019
        ,3783666
        ,209550
        ,2602070
        ,4705694
        ,1985127
        ,1965010
        ,1965017
        ,1527648
        ,4930925
        ,447387
        ,5110202
        ,1248971
        ,1534561
        ,5118053
        ,5118051
        ,1786733
        ,4495413
        ,4035030
        ,2677670
        ,4546724
        ,109855
        ,445729
        ,169925
        ,3560154
        ,4681400
        ,720663
        ,1075553
        ,4730542
        ,980529
        ,4506552
        ,980521
        ,299518
        ,1474322
        ,2382253
        ,345899
        ,4341439
        ,2572586
        ,2382259
        ,2229081
        ,954619
        ,2275183
        ,2808172
        ,4862829
        ,1936917
        ,4543501
        ,1974957
        ,4590535
        ,755066
        ,607304
        ,2038056
        ,4982950
        ,132663
        ,1612995
        ,2146918
        ,3529621
        ,2676785
        ,978397
        ,2676787
        ,1945175
        ,3871367
        ,1754553
        ,1065511
        ,4310737
        ,3162570
        ,1147839
        ,1754559
        ,1358210
        ,3947952
        ,218096
        ,1623239
        ,4784231
        ,3587511
        ,1755203
        ,1623231
        ,652640
        ,1015054
        ,680394
        ,680395
        ,680396
        ,4552664
        ,680398
        ,862894
        ,702461
        ,1194285
        ,1698603
        ,1465638
        ,552617
        ,1280100
        ,3751343
        ,646494
        ,4491410
        ,1288731
        ,4342166
        ,1288738
        ,2517929
        ,1582638
        ,3576444
        ,2493509
        ,3801564
        ,3538300
        ,2670957
        ,3785086
        ,2952081
        ,2010959
        ,2010955
        ,4396559
        ,1904505
        ,667790
        ,977529
        ,1305624
        ,1852510
        ,4584778
        ,1437242
        ,1882998
        ,703733
        ,555340
        ,1281275
        ,4655026
        ,2337775
        ,4001420
        ,2337777
        ,726087
        ,4463176
        ,2564117
        ,1626344
        ,135947);
        return $this->userList;
    }
}
$userDetail = new QueryPointUserDetail();
$userDetail->main();