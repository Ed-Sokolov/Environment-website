import Chart from 'chart.js/auto'
import axios, { type AxiosResponse } from 'axios'
import { type Location } from '../types/location'
import Tab from './Tab'
import { type Environment } from '../types/environment'
import { type Environments, environments } from '../chart/datasets/environments'
import ChartDataLabels from 'chartjs-plugin-datalabels'
import { type DataItem } from '../types/chart'
import { formatters } from '../chart/formatters'

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

    public static generateChart(charts: Chart[], canvas: HTMLCanvasElement, data: Location, type: Environments): void
    {
        charts.push(new Chart(canvas, {
            type: 'bar',
            plugins: [ChartDataLabels],
            data: {
                labels: data.environments.map((environment: Environment) => environment.created),
                datasets: environments(type, data)
            },
            options: {
                animation: {
                    delay: 1000
                }
            }
        }))
    }

    public static generateDataItem(data: Location, dataKey: keyof Environment, label: string, type: Environments): DataItem
    {
        return {
            data: data.environments.map((environment: Environment) => Math.round(Number(environment[dataKey]))),
            label: label,
            datalabels: {
                font: {
                    weight: 500,
                    size: 18,
                },
                anchor: 'end',
                align: 'end',
                offset: -30,
                formatter: formatters[type]
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
