import { type Location } from '../../types/location'
import { type DataItem} from '../../types/chart'
import Graph from '../../modules/Graph'

export type Environments = 'temp' | 'humidity' | 'wind'

export const environments = (type: Environments, location: Location): DataItem[] => {
    const data: DataItem[] = []

    switch (type)
    {
        case 'temp':
            data.push(Graph.generateDataItem(location, 'temp_c', 'Temp (℃)', 'temp'))
            data.push(Graph.generateDataItem(location, 'feelslike_c', 'It feels like (℃)', 'temp'))
            break
        case 'humidity':
            data.push(Graph.generateDataItem(location, 'humidity', 'Humidity (%)', 'humidity'))
            break
        case 'wind':
            data.push(Graph.generateDataItem(location, 'wind_kph', 'Wind (kph)', 'wind'))
            data.push(Graph.generateDataItem(location, 'gust_kph', 'Gust of wind (kph)', 'wind'))
            break
    }

    return data
}
