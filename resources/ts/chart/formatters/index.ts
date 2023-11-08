import { type Environments } from '../datasets/environments'

type Formatter = {
    [k in Environments]: (value: string) => string
}

const windFormatter = (value: string): string => `${value} kph`
const humidityFormatter = (value: string): string => `${value}%`
const tempFormatter = (value: string): string => `${value}℃`

export const formatters: Formatter = {
    temp: tempFormatter,
    wind: windFormatter,
    humidity: humidityFormatter,
}
