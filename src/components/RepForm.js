import UsStates from "./UsStates"
import CoStates from "./CoStates"
import RuStates from "./RuStates"
import EsStates from "./EsStates"
import Countries from "./Countries"
function RepForm({ handleChange, handleSubmit, fields }) {
	const stateSelect = () => {
		switch (fields.country) {
			case "CO":
				return <CoStates handleChange={handleChange} fields={fields} />
				break
			case "RU":
				return <RuStates handleChange={handleChange} fields={fields} />
				break
			case "ES":
				return <EsStates handleChange={handleChange} fields={fields} />
				break
			default:
				return <UsStates handleChange={handleChange} fields={fields} />
		}
	}
	return (
		<form id="rep-form" onSubmit={handleSubmit}>
			<div className="field-container">
				<label htmlFor="productLine">Product Line</label>
				<select className="field" name="productLine" value={fields.productLine} onChange={handleChange} required>
					<option value="">Select</option>
					{armObj.productLines.map(prod => {
						return <option value={prod}>{prod}</option>
					})}
				</select>
			</div>
			<div className="field-container">
				<label htmlFor="industry">Industry</label>
				<select className="field" name="industry" value={fields.industry} onChange={handleChange} required>
					<option value="">Select</option>
					{armObj.industries.map(ind => {
						return <option value={ind}>{ind}</option>
					})}
				</select>
			</div>
			<div className="field-container">
				<label htmlFor="email">Email</label>
				<input className="field" type="email" name="email" value={fields.email} onChange={handleChange} required />
			</div>
			<div className="field-container">
				<label htmlFor="firstName">First Name</label>
				<input className="field" type="text" name="firstName" value={fields.firstName} onChange={handleChange} required />
			</div>
			<div className="field-container">
				<label htmlFor="lastName">Last Name</label>
				<input className="field" type="text" name="lastName" value={fields.lastName} onChange={handleChange} required />
			</div>
			<div className="field-container">
				<label htmlFor="company">Company</label>
				<input className="field" type="text" name="company" value={fields.company} onChange={handleChange} required />
			</div>
			<div className="field-container">
				<label htmlFor="postalCode">Zip/Postal Code</label>
				<input className="field" type="text" name="postalCode" value={fields.postalCode} onChange={handleChange} required />
			</div>
			<div className="field-container">
				<label htmlFor="city">City</label>
				<input className="field" type="text" name="city" value={fields.city} onChange={handleChange} required />
			</div>
			{stateSelect()}
			<Countries handleChange={handleChange} fields={fields} />
			<input type="submit" />
		</form>
	)
}

export default RepForm
