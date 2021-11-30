function EsStates({ handleChange, fields }) {
	return (
		<div className="field-container">
			<label htmlFor="state">Spanish Province</label>
			<select className="field" name="state" value={fields.state} onChange={handleChange} required>
				<option value="">Select</option>
				<option value="AN">Andalusia</option>
				<option value="AR">Aragon</option>
				<option value="AS">Asturias</option>
				<option value="CN">Canarias</option>
				<option value="CB">Cantabriea</option>
				<option value="CM">Castilla/La Mancha</option>
				<option value="CL">Castilla y leon</option>
				<option value="CT">Catalugna</option>
				<option value="EX">Extremadura</option>
				<option value="GA">Gallicia</option>
				<option value="IB">Islas Baleares</option>
				<option value="RI">La Rioja</option>
				<option value="MD">Madrid</option>
				<option value="MC">Murcia</option>
				<option value="NC">Navarre</option>
				<option value="PV">Pais Vasco</option>
				<option value="VC">Valencia</option>
			</select>
		</div>
	)
}

export default EsStates
