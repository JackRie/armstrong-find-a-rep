function CoStates({ handleChange, fields }) {
	return (
		<div className="field-container">
			<label htmlFor="state">Columbian State</label>
			<select className="field" name="state" value={fields.state} onChange={handleChange} required>
				<option value="">Select</option>
				<option value="AMA">Amazonas</option>
				<option value="ANT">Antioquia</option>
				<option value="ARA">Arauca</option>
				<option value="ATL">Atlantico</option>
				<option value="BOL">Bolivar</option>
				<option value="BOY">Boyaca</option>
				<option value="CAL">Caldas</option>
				<option value="CAQ">Caqueta</option>
				<option value="CAS">Casanare</option>
				<option value="CAU">Cauca</option>
				<option value="CES">Cesar</option>
				<option value="CHO">Choco</option>
				<option value="COR">Cordoba</option>
				<option value="CUN">Cundinamarca</option>
				<option value="DC">Capital Dist. de Bogota</option>
				<option value="GUA">Guainia</option>
				<option value="GUV">Guaviare</option>
				<option value="HUI">Huila</option>
				<option value="LAG">La Guajira</option>
				<option value="MAG">Magdalena</option>
				<option value="MET">Meta</option>
				<option value="NAR">Narino</option>
				<option value="NSA">North Santander</option>
				<option value="PUT">Putumayo</option>
				<option value="QUI">Quindio</option>
				<option value="RIS">Risaralda</option>
				<option value="SAN">Santander</option>
				<option value="SAP">San Andres Providencia</option>
				<option value="SUC">Sucre</option>
				<option value="TOL">Tolima</option>
				<option value="VAC">Valle del Cauca</option>
				<option value="VAU">Vaupes</option>
				<option value="VID">Vichada</option>
			</select>
		</div>
	)
}

export default CoStates
