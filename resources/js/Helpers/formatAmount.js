export const formatAmount = ({ amount = 0, hasSymbol = false }) => {
  let valueFormated = amount
    .toString()
    .replace(/[^\d.]|(\.(?=.*\.))/g, '') // Elimina caracteres no numéricos excepto puntos
    .replace(/^(\d+\.\d{0,2})\d*$/, '$1') // Asegura que solo haya dos decimales
    .replace(/(\d)(?=(\d{3})+(\.\d+)?$)/g, '$1,')
  return `${hasSymbol ? '$ ' : ''} ${valueFormated}`
}
