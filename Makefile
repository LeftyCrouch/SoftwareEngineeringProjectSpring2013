# Sample Makefile for Web Programming students
# 
# by Darren Provine, 14 September 2002
# edited by Christopher Crouch
# These lines should be the only ones you have to change for many
# projects.
DESTDIR = /export/home/crouch59/public_html/swe
TARGETS = loginPage.php login.php logout.php homePage.php registrationPage.html changePasswordPage.php stylesheet.css images/* \
          Connect.php changePassword.php register.php addAdmin.php updateUserType.php categoriesPane.php caseFiles.php casePane.php \
          questions.php questionsPane.php diagnosticPane.php diagnosticTools.php getPDF.php addCase.php diagnosticList.php \
          orderATest.php resetCase.php storePDF.php delete.php deleteCase.php storeCase.php addQuestions.php storeQuestion.php \
          modifyQuestions.php editQuestion.php addTools.php storeTool.php 
SOURCES = loginPage.php login.php logout.php homePage.php registrationPage.html changePasswordpage.php stylesheet.css images/* \
          Connect.php changePassword.php register.php addAdmin.php updateUserType.php categoriesPane.php caseFiles.php casePane.php \
          questions.php questionsPane.php diagnosticPane.php diagnosticTools.php getPDF.php addCase.php diagnosticList.php \
	  orderATest.php resetCase.php storePDF.php delete.php deleteCase.php storeCase.php addQuestions.php storeQuestion.php \
          modifyQuestions.php editQuestion.php addTools.php storeTool.php
# This target is just here to be the top target in the Makefile.
# There's nothing to compile for this one.
all: $(TARGETS)

# You might want to look up mkdir(1) to see about that -p flag.
install: $(TARGETS)
	@if [ ! -d $(DESTDIR) ] ; then mkdir -p $(DESTDIR); fi
	@for f in $(TARGETS)                 ; \
	do                                     \
		/usr/sbin/install -c $(DESTDIR) -m 444 $$f ; \
	done

# Note that here we don't blow away the directory, and so we
# be sure and tell the user.  The reason not to delete the
# directory is that it may have other files in it.  Checking
# for, and deleting, any such files will have to be done manually.
# (How could this be improved?)
#
# Note also that the @ sign keeps the echo lines from being echoed
# before they are run.  (That could be confusing.)  This little
# trick (and many more) can be discovered by consulting make(1S).
deinstall:
	cd $(DESTDIR) ; /bin/rm -f $(TARGETS)
@echo "   ==>   removed file(s): $(TARGETS)"
@echo "   ==>   left directory : $(DESTDIR)"

redo: deinstall install

clean:
	/bin/rm -f core $(TARGETS)
