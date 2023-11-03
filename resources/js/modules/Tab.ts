import Chart from 'chart.js/auto'
import { type Location } from '../types/location'
import { type Environment } from '../types/environment'

export default class Tab {
    public static generateMainTab(nav: HTMLDivElement, content: HTMLDivElement, data: Location, id: number, charts: Chart[]): void {
        const
            navLink: HTMLButtonElement = document.createElement('button'),
            tabContent: HTMLDivElement = document.createElement('div'),
            city: string = data.city.toLowerCase()

        navLink.classList.add('nav-link')
        navLink.classList.add('text-uppercase')
        navLink.setAttribute('id', `v-pills-${city}-tab`)
        navLink.setAttribute('data-bs-toggle', 'pill');
        navLink.setAttribute('data-bs-target', `#v-pills-${city}`)
        navLink.setAttribute('type', 'button')
        navLink.setAttribute('role', 'tab')
        navLink.setAttribute('aria-controls', `v-pills-${city}`)
        navLink.setAttribute('aria-selected', id === 0 ? 'true' : 'false')
        navLink.innerHTML = `${data.city}`

        tabContent.classList.add('tab-pane')
        tabContent.classList.add('fade')
        tabContent.setAttribute('id', `v-pills-${city}`)
        tabContent.setAttribute('role', 'tabpanel')
        tabContent.setAttribute('aria-labelledby', `v-pills-${city}-tab`)
        tabContent.setAttribute('tabindex', `0`)

        Tab.generateGraphTab(tabContent, data, charts)

        if (id === 0) {
            navLink.classList.add('active')

            tabContent.classList.add('show')
            tabContent.classList.add('active')
        }

        nav.appendChild(navLink)
        content.appendChild(tabContent)
    }

    public static generateGraphTab(parentContent: HTMLDivElement, data: Location, charts: Chart[]): void
    {
        const
            tab: HTMLDivElement         = document.createElement('div'),
            nav: HTMLUListElement       = document.createElement('ul'),
            content: HTMLDivElement     = document.createElement('div')

        tab.classList.add('tab-wrapper')

        nav.classList.add('nav')
        nav.classList.add('nav-pills')
        nav.classList.add('mb-3')
        nav.classList.add('justify-content-center')
        nav.classList.add('gap-3')
        nav.classList.add('w-100')
        nav.setAttribute('id', 'pills-tab')
        nav.setAttribute('role', 'tablist')

        content.classList.add('tab-content')
        content.setAttribute('id', 'pills-tabContent')

        Tab.generateTabItem(nav, content, tab, data, 'temp_c', charts, 'Temp (℃)', true)
        Tab.generateTabItem(nav, content, tab, data, 'humidity', charts, 'Humidity (%)')
        Tab.generateTabItem(nav, content, tab, data, 'wind_kph', charts, 'Wind (kph)')
        Tab.generateTabItem(nav, content, tab, data, 'gust_kph', charts, 'Gust of wind (kph)')

        parentContent.appendChild(tab)
    }

    public static generateTabItem(nav: HTMLUListElement, content: HTMLDivElement, tab: HTMLDivElement, data: Location, itemKey: keyof Environment, charts: Chart[], navLinkTitle: string, isActive: boolean = false): void
    {
        const
            navItem: HTMLLIElement      = document.createElement('li'),
            navLink: HTMLButtonElement  = document.createElement('button'),
            tabContent: HTMLDivElement  = document.createElement('div'),
            canvas: HTMLCanvasElement   = document.createElement('canvas'),
            city: string                = data.city.toLowerCase()

        navLink.classList.add('nav-link')
        navLink.classList.add('text-uppercase')
        navLink.setAttribute('id', `pills-${city}-${itemKey}-tab`)
        navLink.setAttribute('data-bs-toggle', 'pill')
        navLink.setAttribute('data-bs-target', `#pills-${city}-${itemKey}`)
        navLink.setAttribute('type', 'button')
        navLink.setAttribute('role', 'tab')
        navLink.setAttribute('aria-controls', `pills-${city}-${itemKey}`)
        navLink.setAttribute('aria-controls', `pills-${city}-${itemKey}`)
        navLink.setAttribute('aria-selected', isActive ? 'true' : 'false')
        navLink.innerHTML = navLinkTitle

        navItem.classList.add('nav-item')
        navItem.setAttribute('role', 'presentation')

        navItem.appendChild(navLink)
        nav.appendChild(navItem)

        tabContent.classList.add('tab-pane')
        tabContent.classList.add('fade')
        tabContent.setAttribute('id', `pills-${city}-${itemKey}`)
        tabContent.setAttribute('role', 'tabpanel')
        tabContent.setAttribute('aria-labelledby', `pills-${city}-${itemKey}-tab`)
        tabContent.setAttribute('tabindex', '0')
        tabContent.appendChild(canvas)

        if (isActive)
        {
            navLink.classList.add('active')
            tabContent.classList.add('show')
            tabContent.classList.add('active')
        }

        charts.push(new Chart(canvas, {
            type: 'bar',
            data: {
                labels: data.environments.map((environment: Environment) => environment.created),
                datasets: [{
                    data: data.environments.map((environment: Environment) => Math.round(Number(environment[itemKey]))),
                    label: navLinkTitle
                }]
            },
            options: {
                animation: {
                    delay: 1000
                }
            }
        }))

        content.appendChild(tabContent)
        tab.appendChild(nav)
        tab.appendChild(content)
    }
}
