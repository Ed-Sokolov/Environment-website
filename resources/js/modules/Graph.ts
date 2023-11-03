import Chart from 'chart.js/auto'
import axios, { type AxiosResponse } from 'axios'
import { type Location } from '../types/location'
import Tab from './Tab'

export default class Graph
{
    tab: HTMLDivElement | null = null
    data: Location[] | null = null
    charts: Chart[] = []

    public constructor(tab: HTMLDivElement)
    {
        if (tab && tab instanceof HTMLDivElement)
        {
            this.tab = tab

            this.init()
        }
    }

    private async init(): Promise<void>
    {
        await this.getData()

        if (this.data !== null)
        {
            const
                nav: HTMLDivElement | null      = this.tab.querySelector('div.nav'),
                content: HTMLDivElement | null  = this.tab.querySelector('div.tab-content')

            if (nav && nav instanceof HTMLDivElement && content && content instanceof HTMLDivElement)
            {
                this.data.map((item: Location, id: number): void => {
                    Tab.generateMainTab(nav, content, item, id, this.charts)
                })
            }
        }
    }

    private async getData(): Promise<void>
    {
        const res: AxiosResponse<{data: Location[]}> = await axios.get('/api/data')

        if (res.status !== 200)
        {
            return null
        }

        this.data = res.data.data
    }
}
