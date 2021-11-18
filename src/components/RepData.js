function RepData({ data }) {
	return (
		<div className="repData">
			{data.map((rep, i) => {
				return (
					<div className="rep" key={i}>
						<p>Territory Name: {rep.TerritoryName}</p>
						<p>Territory 2 Id: {rep.Territory2Id}</p>
						<p>Code: {rep.Code}</p>
						<p>Name: {rep.Name}</p>
						<p>Phone: {rep.Phone}</p>
						<p>Email: {rep.Email}</p>
						<p>Company: {rep.Company}</p>
						<p>Street: {rep.Street}</p>
						<p>City: {rep.City}</p>
						<p>State: {rep.State}</p>
						<p>Postal Code: {rep.PostalCode}</p>
						<p>Country: {rep.Country}</p>
					</div>
				)
			})}
		</div>
	)
}

export default RepData
