-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-03-2021 a las 13:13:22
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `keysbank_develop`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `keysbank_accounts`
--

CREATE TABLE `keysbank_accounts` (
  `id` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `idCategory` int(11) NOT NULL,
  `name_account` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `pass_account` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `name_platform` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `info` varchar(255) COLLATE utf8_spanish_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `keysbank_accounts`
--

INSERT INTO `keysbank_accounts` (`id`, `idUser`, `idCategory`, `name_account`, `pass_account`, `name_platform`, `url`, `info`) VALUES
(1, 7, 6, 'BB503EB57F74819983BDD31D61E00F58BAD3A02C36F8586096D0809BADAC5E8D', 'AF76FC9B85EA9846F3EE00CC0A677A437BBB7C37509B8949352CEC84D1301587', 'PayPal', '', ''),
(2, 7, 2, 'BF045988C7D53E5AD88D275BF4B2AD56', '8E6650E0894EF4EBB82665D9AADA3D05', 'Steam', '', ''),
(3, 7, 2, 'AF56D88AB6B98728348AD4EE3E143398145881DBEE35D20E39A88C216B9918E3', '2ADFCCA058080A5977EE2D5C0CB46FAD044F8E3F874F38FC43EE3F49ED6E53B2', 'Amazon Prime', '', ''),
(5, 7, 4, '834FA7C176C41479F95B0259B537C53C', 'EF35615C03142FB990B1BB01940C14D97A8D3FE16D85394D4BCDDC884E592F86', 'Gmail', '', ''),
(6, 7, 5, 'DF416E5835F92514510C4C45C14A3FF749B8274DFBE900C35C6ADCD440F41E5E', '212451DD20692EBCA73F6444ABC62FD0FC9065F6805B7ED996C97D189C985DBD', 'KDE Neon', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `keysbank_keys`
--

CREATE TABLE `keysbank_keys` (
  `id` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `idCategory` int(11) NOT NULL,
  `password` varchar(255) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `keysbank_keys`
--

INSERT INTO `keysbank_keys` (`id`, `idUser`, `idCategory`, `password`) VALUES
(1, 1, 0, '67DE07ED295B217BF7DA1445982ECB26A121853AB7C1694790E2FADECEB27D0DE28D5D348539F55909B6E8A6A814194FB8FF2492AE86B70810090900DDD17CAFFAE130EDA99CB20DD75BF5CBB76F609D9D0EF88FB98E78DE4693B5498EFA5C8F2AE43140FD553F6AB242D5D76CF6E9EFAF147CF3871C3D8D930535CF3105EA9'),
(26, 7, 0, '48BDCF0756D59369C9B3EC117754AEC2A033A8DA658CDAD70EA398595D681236B832DA2648A434EC1D7FA6CC2B7CC98999BD8EF0FEFA8C66C6C2A53E7816CC1AC4EBE8E8E08B0002505053DFA02A3259D595732838F692C7D6853F922CE7B03F1E4B83085B27D881683F5E90B26CC832B267CB69112A37A34689052AF304ADD'),
(27, 7, 1, '8C14F2B86D4ADD63B51AABEE59DCB0A410DA91C3C1BEE3C99EAFA2EC0497794AF73F4962ABB1FABD83FC0801F5C2F41A9501950379CB771C625D8CB6981B7617D9B561F7B78AF0A5947712E88393A31F018289EBFB98A6697AD233BCFEF84B22BCBD791D2EAFACFE2FB2086B58758B9C805FCFB8651F0025BF1C51AE86F6D3D'),
(28, 7, 2, 'FAF7B49395823D964F3032DA1C35F60FEC21F86F427701A1D232D04283B35B8FB9623CC3D11B0C4B987C57F7C9D82511943DD951BCA6B0721EF7FE15B4E3D24535ACD442ECE64240DE5720DB18FB109B515B55DBAB195EF5915992D0C123BA57866E61803746D5F8571A31BCC599EA2BDEF80BB517FF81D7D29332A91808EAA'),
(29, 7, 3, 'B445045F2F14331E2EF3CA14A80B1B1CCFFFF9DC72DF5C65D88CAD468AFD65BC2CD130D4E8C667239DF57137C8A50EA922173CC37C18F2E2184B1B40573588FCA7CBA4B4F840F249BD64AACC17FFCCCD5EF56C3A218290203033EA136E9887329CAEF66585D0D8477FAC492B75C8D8C8B88AC28373A688ED2457222A4BB2BB2'),
(30, 7, 4, '06FF45960D2C2FCBE9D1B2D5F28D7133E77D635D1E94AE2A9B0F0FB341830E39BDF94FD3D573B6BC9869093F66C0B1F844C28A2B0F94134E008ED752A079CBE3E988C20DDD72FE8B86F7DFBACB48D7700BEC136FFEA675BBFECF67E932ABF3C9B4FF9E75779566A42CA735029E54D647562A6D08537BADB742FD3A1B3929984'),
(31, 7, 5, '5D4A63041967243D129D4DC5250FDDA243C3C24C32D5100F58C4BB640E8A4724861C5B6B903B570674FC9D98FEFC5A9AEE0C43EAB017B650EF1C067F9D85B35A1C2171D47D798BA4A63EEFA25C4BAC42A654F58D54FD9D6F775A9FA0CABA9DF8B5972F8A341C35C3522BA9D1F15C944FAC0CC224C737AAA2AE4D207AA11A05A'),
(32, 7, 6, 'DC1BA45A5793A21A80BBFC8B910DFA41B5F39780F2A207A4E824449721B19680AFC3A94F7F6CB7D868CD3AB476D3096ED28587E6271C6412EF08C20869608FB8A2A0C6DA04AF56E985D10149F6B1E6C14E9EB9101C684C4A1DBC5BEB2F45113D01C472725FC286A331D93D2C814B28EFC6EDC08AFD6071870186048F7A0ADBC'),
(33, 8, 0, '091833A9E87DCA84E605F86CC79F01370BC6A53D4B2041605F1C1880190FEF32A34C1C4B30D3C335ED9F8BEAB250137FECAAE0F557D0CF1431BCB8C097362789079BB5AB4C3F16E03745CFFC2AC3900196AE02204CB90C1193CD2DCC7ADC44AEB085B0BDC89A322BF00DAAE19C905B91E7EBD5A249B66A25848921B6A524A48'),
(34, 8, 1, 'F008566916B13466B87C92CA79FD8BFE0FDE3E0F0B0ED65CB24C6E71F552BA64B9E083333592A215F9B1E1E1318B6190B75DE6E2F95508ECCB445C9C122F62D38CA565F621AEB5E618F1B21AA8C8B32A9E00ED199CF0972BC42390F05C2787E99B6B820E33B254B832BBB27B6BE2551826EC1EBF42B7DE06E0A1B19DC249233'),
(35, 8, 2, '61EB5485D5C253699C166C2F1A0E27288B53D8212D92E6CC75884EA6BC531224B3D9D2EC6437ACADD6DE83BC58209526363F180A98887E87E5350EA494C2462F7EE0375217A4CEBD78F8D7E5186D896AF97C8C6B4D6393A19230661DD5ADC841360D395169C3BFAF0B3E7B18F23FAC022A29778803EAAE67D1BC8F1CDD83F4C'),
(36, 8, 3, 'CC707388167AA72DD21FA146C031E3AAF570678CC67CF2830B241C9A31992F77C8184EACB57901A83FDC681DDD2474EBD6A4A3C7945A2D21810B3C461CEF6933A57A102712218EAB64D2C5748906E9C77E70B2526F5C1681C9978CF9A6F43005C65D68B37C409C89C8D7BEDF757E87DB7B798F91502FB7B2E25407203CD9686'),
(37, 8, 4, '5EFEADCF5F9642F0D4BA872DA40E2D7B22FBF03900BE2E6EFCAC6DECFAF4EC3CE770B3C1186B3D489F2594042F59C129250D301BAF8397245E20CB13C48DF0E5B1F23D6F98E7D3ED71FA934D5E56A1D6A1D428F0C59DAE81061E8070DAB2C5B36FF31F40E27C0D33D05FCB6404D6055A3DB273CFE2BD601012CBB1024A9D1EC'),
(38, 8, 5, '61D75AC637E39BEC80356DD1450B30C836658A00F98344EE967DE7BA26E0ABD8F37E74CECEA0ADEB9EAE8B8A718B2B21D4000C17EE0BF804DDDDCAB07238B402430ACFA38A860689E34F00E2BDCED874286B9390D6FB73EB0990108138F94E7B2082BB74B62F161908D82F83EC08076FB47EA0174050D82397DB8A660717E6B'),
(39, 8, 6, '0E4051074082E1724B55A890F72ECE59DC4377340898488DC203D91E9E81D4C3B126512D76FB11D2AAF7CDFA9177516EDCC6D3243C93EAC044C3F60D3D339B37598442AF47989133C180D5A9F9F5B069AEE9D57CFEA18E51EDC8C1867C3CDEB3FD76470DE0C3E78C5CBDD4F16D074B6B97F4D51C2AEB97A32E0CCEF7AAE078C'),
(40, 9, 0, '3FEB4E8E620FE88B489074DE311CE216446C704D186A900CDBD44CCBD15E15FD405D6F6E2D0D53907DE4662572EFA8AC43F1AE3E3CCE03762F2114C1BA04341060C31BD843C5BD033D4D36FA33CFB9FD97C36C7F16BE6A1CA7CC3A85D25181FAC27B94E6DF54ADA81600F23E494D1B9BB6E76EF72C2192BDFCBEB2D527BF6F0'),
(41, 9, 1, '32A2C8C3B882194DF05C57FBDD248912E79480C3CB67E0CA4C1549047E89C2B4DE3D2993915D2B93C98C3409C14B50270AE4C7E3FFA09A65E6DEA0EE9B0B6D909813E9A7E5464A4F197F1A9B67010254E5C6CA7F8468A8046C363A9FE7A850028589E47147ACA4E26A9063649BD0378C3213495D394B0371032DABB34F28A7C'),
(42, 9, 2, '0715118422A657D93DE869E193EA8F965D439A3D1B72D57F2FE937DFC5EB3EC5AC7624C65BB214A01EA2F666317009FB19218F0F8D1474D1619528F7E6C781AF226D5187233293DCEEA7F24FA5BE0734A749F40ED5E4B7778D041D85584C61466E99B24940F4C52BF63C831ED235EEBDFCAE25555ACCCAC35068CC23CE51C3C'),
(43, 9, 3, '7CFD68ADEADC18D81F953DFBBF7E03D61DC3E774FD737A48E7310455721392E9A21C427E26CC2A7559AAD28E7D75DCD410B61D258B577F6CC0FD76C201C678FF347C6096AE6C1D8CF4FDA7ABE73EE8E1649874D62BA9A063C7C57F48F6887B156BC383FA3E1FAB0D8B9C98B0ADD311F8AE9933E79431B9FF266A542875890F2'),
(44, 9, 4, 'D53F2FAED97FEB25B921229130D82DAD2D83F30F33010E3ADC8647197B4035C49581B73887AB76CE46E463206F0995FFAEB032B74B824A99102C5D27873A1FCB23BB1B7667B442D10E0E104FA6B61888C11C6A23FEBE84236DEFDF942E7DE92C94BDAA3F4F02A997F020E403ED28E64E9F00C6E0B9330A44A2CF29E4B0D6080'),
(45, 9, 5, '3E0159B7D49C6D5D5B16DC71BC259172F798D61473AE631F596FE140DF06385DA385FC4E9A942653D965A788FBBE471E2D8C02B851D49FA3D87D0F4CC1120FBA96CB8BCA51FCA5486DFBE44C0F6CF332C6D16F54EA2E8BA6EF17371BDC86010BAFD5974FC1F2B039C4BB2DA2BD2CA9C446F9607FC49A597E4120E70EE37DC53'),
(46, 9, 6, '41C91BE822AA350E2EDD0CC473F1BB05066F20525B31E3D64227BDC02C17EF69495192A8E007440604767D29BD0A24D0518028483FF8F34D826701DB367F94DF237DAE606FD5A44A91E39223FF4567B849B076FCEDA226118D6A8577E13C097A2741B5FBE81E4C4E6FF8CA12E385636BB07D18CCAC4FB7F091E3B0708299887'),
(47, 10, 0, '94425631099A9AAAD31FF897EC9C59CFF217A7ED7FD75494C0BD1A05D0711EAD3A4EE4193BEFC27625CCE3DC50CC4C7481E5E727F079E800DE65B702797BDAC2394FF242C000635BD1C498048BC41C618E6E368E855C80D87D77DC1DC5FE8B101F3EDFCE2048F290623A63C51D5867F7C9E32367E7CC0099D7D49AE35049C98'),
(48, 10, 1, '4C6D8773C6AEA954F93FF5B4BA1B4D13C9C2A809A1FB7DE883BC7D847CF45CB0395C240D913025A4E9AB7F7A9606A6582F3131DFA68EBEAE2EC854C4CFA743C62EE402AD2036344A483EF1727221DBA8428D0BBC3B89D89CC94097A7576B26D40F1F20D71162850A7F0A7E4445ED845882F46897BD783D1E06D1476455E5F78'),
(49, 10, 2, 'E7B5CEE5D28C865986D8BD7FCBFC43B6C583AFDDDEB6D98EC1FF7BAD6930680CF9A64CBE79FE803E238B874FAA7B912A5AF9C7D5435BA96421CE550CDD56F9C8F5D20556CC506B72516EAA717EB80B854223F643D57D60D5CF78EBB9620BCF2384D2C6BB1B937088CA112B02EF3780A10D126064C5D8A4E6CA89B6225CE7700'),
(50, 10, 3, '25CCB42022E8FBFD32D24293CC465CE4EE254DB9C6D4AE6E2029B4C800E513E88F088A364985DB1764FAA351522C8B6C6B2EA35AAFE51C0CDDBA4A0AB9CA390ACC82A79B2C15E7D761EDD93B6CC9C5AEEA565155454ED5FA831187F39B21DB4DDE5FA6F71EA0E64526DFA83942210EA84D046FC39DDC76625777AC523CD6F35'),
(51, 10, 4, '83CC34F49808E45DA20D5A96AFAC48EE17DFE8857A498928B6D640C2DBFE789BEE07485C98C4843AE260C86B79349513946DE314EEAA0FF1E3D1359DD9290826529FFB8D30421A71AB2AF05D2E0C5766F8A9941ECA87312E4D3BF5D97C1A0646AF4BA7AC30384398E0AEDC6E4AA1EB5FED31D8B631033579BF2D584CFB55AD6'),
(52, 10, 5, 'FADB7B6BEDF97F88DC559C4A3EE781D2FA253F647FDDA423B3678F372FD8341FDECF269D5FAAEC2761F491C19C2F1DA2339F9539D1DD6D4A468D5D1C368A80A1A119E5E5EDDEE486CD13874519CF31921E36218084B3E757A21BB0C762FE21FC576652720622371E2D9F0D50CBA790BB43537825042883663ECA8414D4A10CB'),
(53, 10, 6, 'FE81F5B545D1B482ECCE11023A0F6BB56E76CA60B9266BC9FAE7421914940DCAA365B4D4E64B58E15FA0F10FAFDF4EF1E1AA438EB7073A7D535D542131A5357DB12C5DA43A66DA02DF735E10B7B6B6E91020DD24A39019FE73DD0827E7879E75E8C33230587E24CBC5614CC29AF3DDE4E99FBCA4A93009C86FFC6E8D9EF52C3'),
(54, 11, 0, '28C601DBCDEA7544D4C1B84064FC78081B032F84E1519F02BC19356287307ABB3F523B3202537F28E8D1F355C6E48227BE749BB5745B9445B2C78D75463FEC5688F5D77521B8204DD28EC8F8FEE80015D4C9FDC9DFCD12F824464083F8544EB256309E23E5C3131BC01C419E6368B0B5A46732DBB789FF4B51129377E570EC2'),
(55, 11, 1, '1069DC9C0516ADCC44CFC7392C3D50C0551D91B1D60243D70CE4B7B560C1E6A8FEE32BAC212325EC1D77719BC556754E2FA0E65DE76C27914EFEB8796A7542EE0806E766A67BAB8C53E85DC027A355EAFC73F5B3914358A6D18FA9A3D3411F67A3EA182660C1139A64AEA149D32666E5C1B3BF6F4E90D31E3A23739139644BC'),
(56, 11, 2, '27F41A80A12EE3F21E192336CC4B5D6567ACF714376EA5AEAD3F80A17FCC534F4201BB70DFE543C6F66933FC4EE48A199FEC2E76ED890AC282F11F66229112411F7DD37AD11B81C9A8774A4F3D9A7F7CCBC839363B812CCA218E310A9FB127BABF230CC945A8E34E26F33E4B1026BB19BDE6CB5CFC4F8C2C69ADD83AF25A796'),
(57, 11, 3, '561525ED3A77C288BABDCB178CBAC314E38906828D028C421ADF39BA94F262CA9CB396D73AC42338CECE91479A82A9EC7047353544CEC98A834C82A44DF46D4C0C218C5C100843B66F951CFFFC41807F4E85F366C35277AFED7F616A4D85FB60E8031C336DB835799B33703B8B6C943224BCC187662F110423FBCF3DDD4D642'),
(58, 11, 4, '56FF48B4A0976AF87AB55CA52FEA69AD87240B2FECBA9BA2BFA4CAF569A895461319425CB31AFF7253FF516D57F71B14B7EA9980B3207E49BFC9CB7E338456D9EDF9062727815FBA20A0425CA743E27006979EA250473115C38C5C81DF58F2DA608B522EC0B22B039F6655E7ADB38C461F3B5629F806B4DCF1F5094B7B4BD81'),
(59, 11, 5, 'E399CBD0860FFCE37E2D727F6C4641FB5220B67BCE205543AD891F6DEA16086D77721DC5BD302A4A99DC8781F14CF089C149D2AAE1E410BC1F929E71629AEC54DAE546238E0F84FE32B7EF8880FF9CEB18BD9DB9B7E275EAE99B01A5F5D0C02870FD207C7CC305BE9FBE594533D21CB91708824C00BC1A68FC0E1AB465FDB37'),
(60, 11, 6, '95280172849BDBBBD51807E3A4995BD64D1C5EC6CCC0A399CB611FB247212254220478F6FA3EDD8B366A78FCF956790B10EC53122C1FFECE644C0BD0F560F78F99BB830EA548507EB538302EDFF450AA003CC6986A5893EC4563D51E0410BC0DCC51AC452D2DFC22BCB531A619B610BF43A0615F326E6491EB75F4ABFD74080');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `keysbank_platforms_list`
--

CREATE TABLE `keysbank_platforms_list` (
  `id` int(11) NOT NULL,
  `idCategory` int(11) NOT NULL,
  `idSubcategory` int(11) NOT NULL,
  `name` varchar(30) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `keysbank_platforms_list`
--

INSERT INTO `keysbank_platforms_list` (`id`, `idCategory`, `idSubcategory`, `name`) VALUES
(1, 1, 1, 'Blogger'),
(2, 1, 1, 'Medium'),
(3, 1, 1, 'Tumblr'),
(4, 1, 1, 'WordPress'),
(5, 1, 2, 'Flipboard'),
(6, 1, 2, 'Pinterest'),
(7, 1, 2, '500px'),
(8, 1, 3, 'Digg'),
(9, 1, 3, 'Quora'),
(10, 1, 3, 'Reddit'),
(11, 1, 3, '4chan'),
(12, 1, 4, 'Instagram'),
(13, 1, 4, 'Snapchat'),
(14, 1, 4, 'TikTok'),
(15, 1, 5, 'GitHub'),
(16, 1, 5, 'GitLab'),
(17, 1, 5, 'LinkedIn'),
(18, 1, 6, 'Facebook'),
(19, 1, 6, 'Twitter'),
(20, 2, 7, 'Moodle'),
(21, 2, 7, 'Platzi'),
(22, 2, 7, 'Udemy'),
(23, 2, 7, 'OpenWebinars'),
(24, 2, 8, 'Steam'),
(25, 2, 8, 'Origin'),
(26, 2, 8, 'GoG'),
(27, 2, 8, 'Epic Games'),
(28, 2, 8, 'PlayStation Network'),
(29, 2, 8, 'Xbox Live'),
(30, 2, 9, 'Netflix'),
(31, 2, 9, 'HBO'),
(32, 2, 9, 'Disney+'),
(33, 2, 9, 'Amazon Prime'),
(34, 2, 10, 'Twitch'),
(35, 2, 10, 'YouTube'),
(36, 3, 11, 'Other'),
(37, 3, 11, 'Wallapop'),
(38, 3, 12, 'Ebay'),
(39, 3, 12, 'Amazon'),
(40, 3, 12, 'Milanuncios'),
(41, 3, 12, 'Casa del libro'),
(42, 3, 12, 'Corte inglés'),
(43, 3, 12, 'Media Markt'),
(44, 3, 12, 'Mercadona'),
(45, 3, 12, 'Eroski'),
(46, 3, 12, 'Verkami'),
(47, 3, 12, 'Roll20'),
(48, 3, 12, 'Other'),
(49, 3, 12, 'Worten'),
(50, 3, 12, 'Decathlon'),
(51, 3, 12, 'Dia'),
(52, 3, 12, 'Zara'),
(53, 3, 12, 'Zalandro'),
(54, 3, 12, 'Ali Express'),
(55, 3, 12, 'Leroy Merlin'),
(56, 3, 12, 'PC Componentes'),
(57, 3, 12, 'Ikea'),
(58, 3, 12, 'Kiabi'),
(59, 3, 12, 'H&M'),
(60, 3, 12, 'C&A'),
(61, 3, 12, 'Springfield'),
(62, 3, 12, 'Zooplus'),
(63, 3, 12, 'Maisons du monde'),
(64, 4, 13, 'Bussiness'),
(65, 4, 13, 'Company'),
(66, 4, 13, 'Other'),
(67, 4, 14, 'Hotmail'),
(68, 4, 14, 'Gmail'),
(69, 4, 14, 'Yahoo'),
(70, 4, 14, 'GMX'),
(71, 4, 14, 'AOL'),
(72, 4, 14, 'Other'),
(73, 5, 15, 'Debian'),
(74, 5, 15, 'Red Hat'),
(75, 5, 15, 'CentOS'),
(76, 5, 15, 'Fedora'),
(77, 5, 15, 'Linux Mint'),
(78, 5, 15, 'Ubuntu'),
(79, 5, 15, 'Kubuntu'),
(80, 5, 15, 'Xubuntu'),
(81, 5, 15, 'Mandriva'),
(82, 5, 15, 'Arch Linux'),
(83, 5, 15, 'KDE Neon'),
(84, 5, 15, 'Free BSD'),
(85, 5, 15, 'Open SUSE'),
(86, 5, 16, 'MAC OS'),
(87, 5, 16, 'iOS'),
(88, 5, 17, 'Windows XP'),
(89, 5, 17, 'Windows Vista'),
(90, 5, 17, 'Windows 7'),
(91, 5, 17, 'Windows 8'),
(92, 5, 17, 'Windows 10'),
(93, 5, 17, 'Windows Server 2003-2019'),
(94, 5, 18, 'Android'),
(95, 5, 18, 'Solaris'),
(96, 5, 18, 'Other'),
(97, 6, 19, 'La Caixa'),
(98, 6, 19, 'BBVA'),
(99, 6, 19, 'Santander'),
(100, 6, 19, 'Bankia'),
(101, 6, 19, 'Caja Sur'),
(102, 6, 19, 'Banco Sabadell'),
(103, 6, 19, 'Bankinter'),
(104, 6, 19, 'ING'),
(105, 6, 19, 'OpenBank'),
(106, 6, 20, 'American Express'),
(107, 6, 20, 'MasterCard'),
(108, 6, 20, 'Visa'),
(109, 6, 21, 'PayPal'),
(110, 6, 21, 'Stripe'),
(111, 6, 21, 'WePay');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `keysbank_platform_categories`
--

CREATE TABLE `keysbank_platform_categories` (
  `id` int(11) NOT NULL,
  `category` varchar(30) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `keysbank_platform_categories`
--

INSERT INTO `keysbank_platform_categories` (`id`, `category`) VALUES
(1, 'social_media'),
(2, 'digital_plataforms'),
(3, 'webs/apps'),
(4, 'mails'),
(5, 'operating_systems'),
(6, 'payment_systems');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `keysbank_platform_subcategories`
--

CREATE TABLE `keysbank_platform_subcategories` (
  `id` int(11) NOT NULL,
  `idCategory` int(11) NOT NULL,
  `subcategory` varchar(30) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `keysbank_platform_subcategories`
--

INSERT INTO `keysbank_platform_subcategories` (`id`, `idCategory`, `subcategory`) VALUES
(1, 1, 'Blogs'),
(2, 1, 'Content organizer'),
(3, 1, 'Forums'),
(4, 1, 'Multimedia content'),
(5, 1, 'Professionals'),
(6, 1, 'Social media'),
(7, 2, 'Academic'),
(8, 2, 'Games'),
(9, 2, 'Series/films'),
(10, 2, 'Streaming/videos'),
(11, 3, 'Apps'),
(12, 3, 'Webs'),
(13, 4, 'Privates'),
(14, 4, 'Publics'),
(15, 5, 'GNU/Linux'),
(16, 5, 'MAC OS'),
(17, 5, 'Microsoft Windows'),
(18, 5, 'Others'),
(19, 6, 'Bank accounts'),
(20, 6, 'Credit cards'),
(21, 6, 'Digital payments');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `keysbank_users`
--

CREATE TABLE `keysbank_users` (
  `id` int(11) NOT NULL,
  `nick` varchar(16) COLLATE utf8_spanish_ci NOT NULL,
  `pass` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `surname` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `perfil` enum('USER','ADMIN') COLLATE utf8_spanish_ci NOT NULL,
  `current_state` enum('PENDING','ACTIVE','BANNED') COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `keysbank_users`
--

INSERT INTO `keysbank_users` (`id`, `nick`, `pass`, `name`, `surname`, `email`, `perfil`, `current_state`) VALUES
(1, 'admin', 'C66DA34A548C7AD4130B5AFA6287F7B5', NULL, NULL, '', 'ADMIN', 'ACTIVE'),
(7, 'user1', 'C0E9209C41DC09EB94293ED733731744', 'C0E9209C41DC09EB94293ED733731744', '2FD20A08A10EFE74080AE570EF5E5B92', 'user1@hotmail.com', 'USER', 'ACTIVE'),
(8, 'user2', 'F1F9B0255DADA54F724C28DDA6F0D870', 'F1F9B0255DADA54F724C28DDA6F0D870', '3A6EB00672FF2123E72A3DAF68E47EE0', 'user2@hotmail.com', 'USER', 'PENDING'),
(9, 'user3', '23E1AEECD69752BBBB83027E3BD3B9BD', '23E1AEECD69752BBBB83027E3BD3B9BD', '7303473DED419332DA34FF4D058B1B0E', 'user3@hotmail.com', 'USER', 'BANNED'),
(10, 'user4', 'F180DC87E0BE05A17AAF0F852FD68250', 'F180DC87E0BE05A17AAF0F852FD68250', '0AE4065E343CA1BC4E6CE12703FC4B45', 'user4@hotmail.com', 'USER', 'PENDING'),
(11, 'user5', '07C4AFB9673BA2F374A75F10CA9F529C', '07C4AFB9673BA2F374A75F10CA9F529C', '5DFB23F28DC3D3F5883A8629E268B3E5', 'user5@hotmail.com', 'USER', 'PENDING');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `keysbank_accounts`
--
ALTER TABLE `keysbank_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `keysbank_keys`
--
ALTER TABLE `keysbank_keys`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `keysbank_platforms_list`
--
ALTER TABLE `keysbank_platforms_list`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `keysbank_platform_categories`
--
ALTER TABLE `keysbank_platform_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `keysbank_platform_subcategories`
--
ALTER TABLE `keysbank_platform_subcategories`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `keysbank_users`
--
ALTER TABLE `keysbank_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `keysbank_accounts`
--
ALTER TABLE `keysbank_accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `keysbank_keys`
--
ALTER TABLE `keysbank_keys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT de la tabla `keysbank_platforms_list`
--
ALTER TABLE `keysbank_platforms_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT de la tabla `keysbank_platform_categories`
--
ALTER TABLE `keysbank_platform_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `keysbank_platform_subcategories`
--
ALTER TABLE `keysbank_platform_subcategories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `keysbank_users`
--
ALTER TABLE `keysbank_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
