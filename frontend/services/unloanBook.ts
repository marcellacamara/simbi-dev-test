export default async function unloanBook(loanId: string): Promise<void> {
  const body = JSON.stringify({ loan_id: loanId });

  const response = await fetch(`${process.env.NEXT_PUBLIC_API_URL}/api/loans`, {
    method: "DELETE",
    body,
    headers: { "Content-Type": "application/json" },
    mode: "cors",
  });
  if (!response.ok) {
    throw new Error("Failed to delete loan", { cause: response.statusText });
  }
  return response.json();
}
