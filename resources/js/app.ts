import './bootstrap'
import Graph from './modules/Graph'

const tab: HTMLDivElement | null = document.querySelector<HTMLDivElement>('div.tab-wrapper[data-init="tab"]')

if (tab && tab instanceof HTMLDivElement)
{
    new Graph(tab)
}
