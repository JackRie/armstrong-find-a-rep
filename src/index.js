import { useEffect, useState } from "react"
import ReactDOM from "react-dom"
import axios from "axios"
import RepForm from "./components/RepForm"
import RepData from "./components/RepData"
import Loading from "./components/Loading"
import "./index.scss"

function App() {
	const [token, setToken] = useState()
	const [fields, setFields] = useState({})
	const [data, setData] = useState([])
	const [isLoading, setIsLoading] = useState(false)
	const [error, setError] = useState(false)

	useEffect(() => {
		// axios.defaults.headers.common["X-WP-Nonce"] = armObj.nonce
		const options = {
			method: "get",
			url: armObj.urls.proxyTest,
			data: "",
		}
		axios(options)
			.then(response => {
				setToken(response.data)
			})
			.catch(error => {
				setError(true)
				console.log(error)
			})
	}, [])

	const handleChange = e => {
		const name = e.target.name
		const value = e.target.value

		setFields(values => ({ ...values, [name]: value }))
	}
	const handleSubmit = e => {
		e.preventDefault()
		setIsLoading(true)
		const body = {
			token: token,
			data: {
				account: {
					acctInfo: {
						name: `${fields.firstName} ${fields.lastName}`,
						city: fields.city,
						state: fields.state,
						postalCode: fields.postalCode,
						country: fields.country,
						productLine: fields.productLine,
						industryType: fields.industry,
					},
				},
				entryInfo: {
					email: fields.email,
					company: fields.company,
				},
			},
		}
		const options = {
			method: "post",
			url: armObj.urls.proxy,
			data: body,
		}
		axios(options)
			.then(response => {
				console.log(response.data)
				setData(response.data)
				setIsLoading(false)
			})
			.catch(error => {
				console.log(error)
			})
		Array.from(document.querySelectorAll(".field")).forEach(field => setFields(values => ({ ...values, [field.name]: "" })))
	}

	if (error) return <h2>You do not have access to this page.</h2>

	return (
		<div className="armfr-container">
			<RepForm handleChange={handleChange} handleSubmit={handleSubmit} fields={fields} />
			<div className="results">{isLoading ? <Loading /> : <RepData data={data} />}</div>
		</div>
	)
}

export default App

ReactDOM.render(<App />, document.getElementById("find-a-rep"))
