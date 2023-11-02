import axios, { type AxiosResponse } from 'axios'
import { type Location } from '../types/location'

export default class Graph
{
    data: Location[] | null = null

    public constructor()
    {
        this.init()
    }

    private async init(): Promise<void>
    {
        await this.getData()

        if (this.data !== null)
        {
            console.log(this.data);
        }
    }

    private async getData(): Promise<void>
    {
        return await axios.get('/api/data')
            .then((res: AxiosResponse): void => {
                if (res.status === 200)
                {
                    this.data = res.data.data
                }
            })
    }
}
