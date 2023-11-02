export type Environment = {
    id: number

    temp_c: number
    temp_f: number
    feelslike_c: number
    feelslike_f: number

    condition_title: string
    condition_icon: string
    condition_code: number

    wind_mph: number
    wind_kph: number
    wind_degree: number
    wind_dir: string

    pressure_mb: number
    pressure_in: number

    precip_mm: number
    precip_in: number

    humidity: number
    cloud: number

    is_day: boolean

    uv: number

    gust_mph: number
    gust_kph: number

    created: string
}
