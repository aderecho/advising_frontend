import { useRuntimeConfig } from '#app'

export interface CurriculumYear {
  id: number
  year: string
  name?: string
}

export interface College {
  id: number
  code: string
  name: string
}

export interface Program {
  id: number
  code: string
  name: string
  duration_years: number
}

export const CurriculumService = {
  async getCurriculumYears(): Promise<CurriculumYear[]> {
    const config = useRuntimeConfig()
    const apiUrl = (config.public.apiUrl || config.public.apiBase || '/api') as string
    const response: any = await $fetch(`${apiUrl}/curriculum-years`)
    return response?.data || response || []
  },

  async getColleges(): Promise<College[]> {
    const config = useRuntimeConfig()
    const apiUrl = (config.public.apiUrl || config.public.apiBase || '/api') as string
    const response: any = await $fetch(`${apiUrl}/colleges`)
    return response?.data || response || []
  },

  async getPrograms(): Promise<Program[]> {
    const config = useRuntimeConfig()
    const apiUrl = (config.public.apiUrl || config.public.apiBase || '/api') as string
    const response: any = await $fetch(`${apiUrl}/programs`)
    return response?.data || response || []
  }
}
