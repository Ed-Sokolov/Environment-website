import './bootstrap'
import Graph from './modules/Graph'

class App
{
    constructor() {
        this.init()
    }

    init(): void
    {
        this.tabInit()
    }

    private tabInit(): void
    {
        const tab: HTMLDivElement | null = document.querySelector<HTMLDivElement>('div.tab-wrapper[data-init="tab"]')

        if (tab && tab instanceof HTMLDivElement)
        {
            new Graph(tab)
        }
    }
}

new App()

export default App
