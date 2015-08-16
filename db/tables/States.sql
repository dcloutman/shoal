-- A table of US States.

CREATE TABLE `States` (
  `state_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `usps` char(2) NOT NULL,
  `old_gpo` varchar(32) NOT NULL,
  PRIMARY KEY (`state_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;



-- Populate with values

INSERT INTO `States` (`state_id`, `name`, `usps`, `old_gpo`) VALUES
(1, 'Alabama', 'AL', 'Ala.'),
(2, 'Alaska', 'AK', 'Alaska'),
(3, 'Arizona', 'AZ', 'Ariz.'),
(4, 'Arkansas', 'AR', 'Ark.'),
(5, 'California', 'CA', 'Calif.'),
(6, 'Colorado', 'CO', 'Colo.'),
(7, 'Connecticut', 'CT', 'Conn.'),
(8, 'Delaware', 'DE', 'Del.'),
(9, 'District of Columbia', 'DC', 'D.C.'),
(10, 'Florida', 'FL', 'Fla.'),
(11, 'Georgia', 'GA', 'Ga.'),
(12, 'Hawaii', 'HI', 'Hawaii'),
(13, 'Idaho', 'ID', 'Idaho'),
(14, 'Illinois', 'IL', 'Ill.'),
(15, 'Indiana', 'IN', 'Ind.'),
(16, 'Iowa', 'IA', 'Iowa'),
(17, 'Kansas', 'KS', 'Kans.'),
(18, 'Kentucky', 'KY', 'Ky.'),
(19, 'Louisiana', 'LA', 'La.'),
(20, 'Maine', 'ME', 'Maine'),
(21, 'Maryland', 'MD', 'Md.'),
(22, 'Massachusetts', 'MA', 'Mass.'),
(23, 'Michigan', 'MI', 'Mich.'),
(24, 'Minnesota', 'MN', 'Minn.'),
(25, 'Mississippi', 'MS', 'Miss.'),
(26, 'Missouri', 'MO', 'Mo.'),
(27, 'Montana', 'MT', 'Mont.'),
(28, 'Nebraska', 'NE', 'Nebr.'),
(29, 'Nevada', 'NV', 'Nev.'),
(30, 'New Hampshire', 'NH', 'N.H.'),
(31, 'New Jersey', 'NJ', 'N.J.'),
(32, 'New Mexico', 'NM', 'N. Mex.'),
(33, 'New York', 'NY', 'N.Y.'),
(34, 'North Carolina', 'NC', 'N.C.'),
(35, 'North Dakota', 'ND', 'N. Dak.'),
(36, 'Ohio', 'OH', 'Ohio'),
(37, 'Oklahoma', 'OK', 'Okla.'),
(38, 'Oregon', 'OR', 'Oreg.'),
(39, 'Pennsylvania', 'PA', 'Pa.'),
(40, 'Rhode Island', 'RI', 'R.I.'),
(41, 'South Carolina', 'SC', 'S.C.'),
(42, 'South Dakota', 'SD', 'S. Dak.'),
(43, 'Tennessee', 'TN', 'Tenn.'),
(44, 'Texas', 'TX', 'Texas'),
(45, 'Utah', 'UT', 'Utah'),
(46, 'Vermont', 'VT', 'Vt.'),
(47, 'Virginia', 'VA', 'Va.'),
(48, 'Washington', 'WA', 'Wash.'),
(49, 'West Virginia', 'WV', 'W. Va.'),
(50, 'Wisconsin', 'WI', 'Wis.'),
(51, 'Wyoming', 'WY', 'Wyo.'),
(52, 'American Samoa', 'AS', 'A.S.'),
(53, 'Guam', 'GU', 'Guam'),
(54, 'Northern Mariana Islands', 'MP', 'M.P.'),
(55, 'Puerto Rico', 'PR', 'P.R.'),
(56, 'Virgin Islands', 'VI', 'V.I'),
(57, 'U.S. Minor Outlying Islands', 'UM', '');


