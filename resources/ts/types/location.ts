import { type Environment } from './environment'

export type Location = {
    id: number

    city: string
    region: string
    country: string
    timezone: string

    environments: Environment[]
}
