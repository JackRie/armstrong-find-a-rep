function RuStates({ handleChange, fields }) {
	return (
		<div className="field-container">
			<label htmlFor="state">Russian Province</label>
			<select className="field" name="state" value={fields.state} onChange={handleChange} required>
				<option value="">Select</option>
				<option value="AD">Adygey</option>
				<option value="AL">Gorno-Altay</option>
				<option value="ALT">Altay</option>
				<option value="AMU">Amur</option>
				<option value="ARK">Arkhangel'sk</option>
				<option value="AST">Astrakhan'</option>
				<option value="BA">Bashkortostan</option>
				<option value="BEL">Belgorod</option>
				<option value="BRY">Bryansk</option>
				<option value="BU">Buryat</option>
				<option value="CE">Chechnya</option>
				<option value="CHE">Chelyabinsk</option>
				<option value="CHU">Chukot</option>
				<option value="CU">Chuvash</option>
				<option value="DA">Dagestan</option>
				<option value="IN">Ingush</option>
				<option value="IRK">Irkutsk</option>
				<option value="IVA">Ivanovo</option>
				<option value="KAM">Kamchatka</option>
				<option value="KB">Kabardin-Balkar</option>
				<option value="KC">Karachay-Cherkess</option>
				<option value="KDA">Krasnodar</option>
				<option value="KEM">Kemerovo</option>
				<option value="KGD">Kaliningrad</option>
				<option value="KGN">Kurgan</option>
				<option value="KHA">Khabarovsk</option>
				<option value="KHM">Khanty-Mansiy</option>
				<option value="KIR">Kirov</option>
				<option value="KK">Khakass</option>
				<option value="KL">Kalmyk</option>
				<option value="KLU">Kaluga</option>
				<option value="KO">Komi</option>
				<option value="KOS">Kostroma</option>
				<option value="KR">Karelia</option>
				<option value="KRS">Kursk</option>
				<option value="KYA">Krasnoyarsk</option>
				<option value="LEN">Leningrad</option>
				<option value="LIP">Lipetsk</option>
				<option value="MAG">Magadan</option>
				<option value="ME">Mariy-El</option>
				<option value="MO">Mordovia</option>
				<option value="MOS">Moskva</option>
				<option value="MOW">Moscow City</option>
				<option value="MUR">Murmansk</option>
				<option value="NEN">Nenets</option>
				<option value="NGR">Novgorod</option>
				<option value="NIZ">Nizhegorod</option>
				<option value="NVS">Novosibirsk</option>
				<option value="OMS">Omsk</option>
				<option value="ORE">Orenburg</option>
				<option value="ORL">Orel</option>
				<option value="PER">Perm'</option>
				<option value="PNZ">Penza</option>
				<option value="PRI">Primor'ye</option>
				<option value="PSK">Pskov</option>
				<option value="ROS">Rostov</option>
				<option value="RYA">Ryazan'</option>
				<option value="SA">Sakha</option>
				<option value="SAK">Sakhalin</option>
				<option value="SAM">Samara</option>
				<option value="SAR">Saratov</option>
				<option value="SE">North Ossetia</option>
				<option value="SMO">Smolensk</option>
				<option value="SPE">Saint Petersburg City</option>
				<option value="STA">Stavropol'</option>
				<option value="SVE">Sverdlovsk</option>
				<option value="TA">Tatarstan</option>
				<option value="TAM">Tambov</option>
				<option value="TOM">Tomsk</option>
				<option value="TUL">Tula</option>
				<option value="TVE">Tver'</option>
				<option value="TY">Tuva</option>
				<option value="TYU">Tyumen'</option>
				<option value="UD">Udmurt</option>
				<option value="ULY">Ul'yanovsk</option>
				<option value="VGG">Volgograd</option>
				<option value="VLA">Vladimir</option>
				<option value="VLG">Vologda</option>
				<option value="VOR">Voronezh</option>
				<option value="YAN">Yamal-Nenets</option>
				<option value="YAR">Yaroslavli'</option>
				<option value="YEV">Yevrey</option>
				<option value="ZAB">Zabaykal'ye</option>
			</select>
		</div>
	)
}

export default RuStates
