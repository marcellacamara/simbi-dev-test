import { Modal, Box, Typography, Button, TextField } from "@mui/material";
import { useState } from "react";

interface LoanModalProps {
  open: boolean;
  handleClose: () => void;
  bookId: string;
}

const LoanModal: React.FC<LoanModalProps> = ({ open, handleClose, bookId }) => {
  const [userId, setUserId] = useState<string>("");

  const handleLoan = async () => {
    try {
      const response = await fetch(
        `${process.env.API_URL}/api/loans/book/${bookId}`,
        {
          method: "POST",
          body: JSON.stringify({ userId }),
          headers: { "Content-Type": "application/json" },
        }
      );

      if (!response.ok) {
        throw new Error("Erro ao criar o empréstimo");
      }

      alert("Empréstimo criado com sucesso!");
      handleClose();
    } catch (error) {
      alert("Erro ao criar empréstimo");
    }
  };

  return (
    <Modal open={open} onClose={handleClose}>
      <Box
        sx={{
          p: 3,
          backgroundColor: "white",
          width: 300,
          mx: "auto",
          my: "20%",
          borderRadius: "8px",
        }}
      >
        <Typography variant="h6">Fazer Empréstimo</Typography>
        <TextField
          fullWidth
          label="Usuário ID"
          value={userId}
          onChange={(e) => setUserId(e.target.value)}
        />
        <Button variant="contained" onClick={handleLoan}>
          Confirmar Empréstimo
        </Button>
      </Box>
    </Modal>
  );
};

export default LoanModal;
