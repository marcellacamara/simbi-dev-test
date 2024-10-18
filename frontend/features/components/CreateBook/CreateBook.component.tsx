"use client";

import {
  ChangeEvent,
  useEffect,
  useState,
  type FunctionComponent,
} from "react";
import type { CreateBookItemProps } from "./CreateBook.interface";
import {
  Grid,
  Button,
  Dialog,
  DialogTitle,
  InputLabel,
  Input,
  Typography,
  Box,
} from "@mui/material";
import Close from "@mui/icons-material/Close";
import createAuthor from "@/services/createAuthor";
import createBook from "@/services/createBook";

export const CreateBook: FunctionComponent<CreateBookItemProps> = ({
  shouldOpen,
  openCloseControl,
}) => {
  const [cannotCreateBook, setCannotCreateBook] = useState<boolean>(true);
  const [bookInfo, setBookInfo] = useState<BookPan>({
    title: "",
    publisher: "",
    authorFirstName: "",
    authorLastName: "",
  });
  const [loading, setLoading] = useState<{
    isLoading: boolean;
    message: string;
  }>({ isLoading: false, message: "Aguarde" });

  useEffect(() => {
    const hasInvalidInfo = Object.values(bookInfo).some(
      (item) => item.length === 0
    );
    setCannotCreateBook(hasInvalidInfo);
  }, [bookInfo]);

  const handleBookChangeInfo = (event: ChangeEvent<HTMLInputElement>) => {
    setBookInfo({
      ...bookInfo,
      [event.target.id]: event.target.value,
    });
  };

  const handleCreateBookButtonClick = async () => {
    try {
      setLoading({ isLoading: true, message: "Criando Autor" });
      const author = await createAuthor(
        bookInfo.authorFirstName,
        bookInfo.authorLastName
      );
      setLoading({ isLoading: true, message: "Criando Livro" });
      await createBook(bookInfo.title, author.id, bookInfo.publisher);
      setLoading({ isLoading: true, message: "Feito!" });

      setTimeout(() => {
        setLoading({ isLoading: false, message: "Aguarde" });
        openCloseControl(false);
        setBookInfo({
          title: "",
          authorFirstName: "",
          authorLastName: "",
          publisher: "",
        });
      }, 1500);
    } catch (error) {
      setTimeout(
        () => setLoading({ isLoading: false, message: "Houve um Erro" }),
        1500
      );
      return;
    }
  };

  const handleClose = () => {
    setBookInfo({
      title: "",
      authorFirstName: "",
      authorLastName: "",
      publisher: "",
    });
    openCloseControl(false);
  };

  return (
    <Dialog onClose={handleClose} open={shouldOpen} sx={{ padding: "15px" }}>
      <Grid container alignItems="center" justifyContent="space-between">
        <Grid>
          <DialogTitle>Cadastrar um Livro</DialogTitle>
        </Grid>
        <Grid>
          <Button onClick={handleClose}>
            <Close />
          </Button>
        </Grid>
      </Grid>
      <Grid
        container
        alignItems="center"
        justifyContent="center"
        direction="column"
      >
        <Grid>
          <InputLabel htmlFor="title">Título do Livro</InputLabel>
          <Input id="title" onChange={handleBookChangeInfo}></Input>
        </Grid>

        <Grid>
          <InputLabel htmlFor="publisher">Editora</InputLabel>
          <Input id="publisher" onChange={handleBookChangeInfo}></Input>
        </Grid>

        <Grid>
          <InputLabel htmlFor="authorFirstName">
            Primeiro Nome do Autor
          </InputLabel>
          <Input id="authorFirstName" onChange={handleBookChangeInfo}></Input>
        </Grid>

        <Grid>
          <InputLabel htmlFor="authorLastName">
            Segundo Nome do Autor
          </InputLabel>
          <Input id="authorLastName" onChange={handleBookChangeInfo}></Input>
        </Grid>

        <Button
          disabled={cannotCreateBook}
          onClick={handleCreateBookButtonClick}
        >
          Criar Livro
        </Button>
        {loading.isLoading && <Typography>{loading.message}</Typography>}
      </Grid>
    </Dialog>
  );
};
